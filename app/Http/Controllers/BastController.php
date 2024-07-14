<?php

namespace App\Http\Controllers;

use App\Models\Bast;
use App\Models\User;
use App\Models\Detail;
use App\Models\DocumentSet;
use App\Models\Mom;
use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BastController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bast-index', ['only' => ['index']]);
        $this->middleware('permission:bast-create', ['only' => ['create']]);
        $this->middleware('permission:bast-edit', ['only' => ['edit']]);
        $this->middleware('permission:bast-delete', ['only' => ['delete']]);
    }

    public function view($id)
    {
        $project = project::with('users')->where('id', $id)->get();
        $data['bast'] = Bast::where('projectid', $id)->get();
        // $data['mom'] = Mom::with('basts')->where('project', $id)->orderBy('date')->get();
        $data['url'] = '';
        $data['alert'] = '';
        return view('admin.bast.index', ['project' => $project, 'id' => $id], $data);
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {

            $data = Mom::with('basts')->where('project', $request->idMOM)->orderBy('date')->get();
            if ($request->input('bast_filter')) {
                $data = Mom::with('basts')->where('bast', $request->bast_filter);
            }
            $project = project::with('users')->where('id', $request->idMOM)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                ->addColumn('no_bast', function (Mom $mom) {
                    $html = '';
                    $html .= $mom->basts->bast_no ?? '';
                    return $html;
                })
                ->addColumn('action', function ($data, Request $request) {
                    $project =  project::with('users')->where('id', $request->idMOM)->get();
                    $html = '';
                    $html .= '<a href="' . route('mom.print', ['id' => $data->id, 'from' => 'project', 'project' => $project->first()->id]) . '" class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="top" title="Print"><i
                    class="fa fa-print"></i></a>&nbsp;';
                    if (auth()->user()->can('mom-edit')) {
                        $html .= '<a href="' . route('mom.edit', ['project' => $project->first()->id, 'from' => 'project', 'id' => $data->id]) . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if (auth()->user()->can('mom-delete')) {
                        $html .= '<form method="get" action="' . route('mom.delete', $data->id) . '" style="display: inline">
                        <input type="hidden" name="_token" value="' . csrf_token() . '"><input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm(\'' . __('Yakin Ingin Menghapus Mom Ini ??') . '\')"><i class="fa fa-trash"></i></button>&nbsp;
                        </form>';
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function bast_link($id, $projectid)
    {
        $project = project::where('id', $projectid)->get();
        $data['bast'] = Bast::where('projectid', $projectid)->get();
        // $data['mom'] = Mom::where('project', $id)->get();
        $data['url'] = URL::temporarySignedRoute('signature_url', now()->addHours(5), ['id' => $id]);
        $data['alert'] = true;
        $data['id'] = $projectid;
        return view('admin.bast.index', ['project' => $project], $data);
    }

    public function detail($id)
    {
        $head = Bast::where('id', $id)->first();
        $projectid = $head->projectid;
        $project = project::where('id', $projectid)->get();
        $details = Detail::where('bastid', $id)->get();
        foreach ($details as $detail) {
            $detail->format_date = Carbon::parse($detail->tanggaluji)->timezone('Asia/Jakarta')->format('d-m-Y');
            $detail->edit_date =  Carbon::parse($detail->tanggaluji)->timezone('Asia/Jakarta')->format('Y-m-d');
        }
        $data['detail'] = $details;
        $data['mom'] = Mom::where('bast', $id)->orderBy('date')->get();
        return view('admin.bast.detail', ['project' => $project, 'bast' => $head], $data);
    }

    public function create($id)
    {
        $users = User::whereNotIn('id', function ($query) {
            $query->select('id')
                ->from('users')
                ->where('name', 'superadmin');
        })->get();
        $project = project::where('id', $id)->first();
        $kodeauto = Bast::selectRaw('LPAD(CONVERT(COUNT("bast_no") + 1, char(8)) , 3,"0") as invoice')->first();
        $data['format'] = 'BAST/1-16/SMT/BDG/III/2024' . ' - ' . $kodeauto->invoice;
        return view('admin.bast.create', ['users' => $users, 'project' => $project], $data);
    }

    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'projectid' => 'required|integer',
            'sprint' => 'required|integer',
            'nobast' => 'required|string|max:255',
            'revisi' => 'required|integer',
            'phase' => 'required|string',
            'ofnumber' => 'required|integer',
            'nama1' => 'required|string|max:255',
            'nama2' => 'required|string|max:255',
            'perusahaan1' => 'required|string|max:255',
            'perusahaan2' => 'required|string|max:255',
            'jabatan1' => 'required|string|max:255',
            'jabatan2' => 'required|string|max:255',
            'alamat1' => 'required|string',
            'alamat2' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $projectid = $request->projectid;

        $createdate = Carbon::now('Asia/Jakarta');
        Bast::create([
            'projectid' => $projectid,
            'sprint' => $request->sprint,
            'bast_no' => $request->nobast,
            'bast_date' => $createdate,
            'revision' => $request->revisi,
            'phase' => $request->phase,
            'of_number' => $request->ofnumber,
            'nama_pihak1' => $request->nama1,
            'nama_pihak2' => $request->nama2,
            'perusahaan_pihak1' => $request->perusahaan1,
            'perusahaan_pihak2' => $request->perusahaan2,
            'jabatan_pihak1' => $request->jabatan1,
            'jabatan_pihak2' => $request->jabatan2,
            'alamat_pihak1' => $request->alamat1,
            'alamat_pihak2' => $request->alamat2
        ]);

        session()->flash('Success', 'Data Saved!');
        return redirect()->route('bast.view', $projectid);
    }

    public function edit($id, $projectid)
    {
        $project = Project::where('id', $projectid)->first();
        $find = Bast::find($id);
        $data['kodeauto'] = Bast::selectRaw('LPAD(CONVERT(COUNT("bast_no") + 1, char(8)) , 2,"0") as invoice')->first();

        if (!$find) {
            return redirect()->route('bast.view');
        }
        $users = User::whereNotIn('id', function ($query) {
            $query->select('id')
                ->from('users')
                ->where('name', 'superadmin');
        })->get();

        return view('admin.bast.create', ['data' => $find, 'users' => $users, 'project' => $project]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sprint' => 'required|string|max:255',
            'nobast' => 'required|string|max:255',
            'revisi' => 'required|string|max:100',
            'ofnumber' => 'required|string|max:255',
            'nama1' => 'required|string|max:255',
            'nama2' => 'required|string|max:255',
            'perusahaan1' => 'required|string|max:255',
            'perusahaan2' => 'required|string|max:255',
            'jabatan1' => 'required|string|max:255',
            'jabatan2' => 'required|string|max:255',
            'alamat1' => 'required|string',
            'alamat2' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $find = Bast::find($request->bastid);

        if (!$find) {
            return redirect()->route('bast.view', $request->projectid);
        }
        $updatedate = Carbon::now('Asia/Jakarta')->format('d-m-Y');
        $find->update([
            'sprint' => $request->sprint,
            'bast_no' => $request->nobast,
            'revision' => $request->revisi,
            'phase' => $request->phase,
            'of_number' => $request->ofnumber,
            'nama_pihak1' => $request->nama1,
            'nama_pihak2' => $request->nama2,
            'perusahaan_pihak1' => $request->perusahaan1,
            'perusahaan_pihak2' => $request->perusahaan2,
            'jabatan_pihak1' => $request->jabatan1,
            'jabatan_pihak2' => $request->jabatan2,
            'alamat_pihak1' => $request->alamat1,
            'alamat_pihak2' => $request->alamat2

        ]);

        session()->flash('Success', 'Data Updated!');
        return redirect()->route('bast.view', $request->projectid);
    }
    public function delete($id)
    {
        $bast = Bast::where('id', $id)->first();
        $projectid = $bast->projectid;
        $delete = Bast::where('id', $id)->delete();
        $detail = Detail::where('bastid', $id)->delete();

        return redirect()->route('bast.view', $projectid);
    }

    public function create_detail(Request $request)
    {
        $bastid = $request->bastid;
        $detail = Detail::create([
            'bastid' => $bastid,
            'fitur' => $request->fitur,
            'deskripsi' => $request->deskripsi,
            'penguji' => $request->penguji,
            'tanggaluji' => $request->dateuji
        ]);
        return redirect()->route('bast.detail', $bastid);
    }

    public function update_detail(Request $request)
    {
        $update = Detail::where('id', $request->detailid)->update([
            'fitur' => $request->fitur,
            'deskripsi' => $request->deskripsi,
            'penguji' => $request->penguji,
            'tanggaluji' => $request->dateuji
        ]);

        return redirect()->route('bast.detail', $request->bastid);
    }

    public function delete_detail($idbast, $id)
    {
        $delete = Detail::where('id', $id)->delete();
        return redirect()->route('bast.detail', $idbast);
    }

    public function print($id)
    {
        $data['cetak'] = Bast::findOrfail($id);
        $query = Bast::findOrfail($id);
        $data['set'] = DocumentSet::where('name', 'bast')->first();
        $data['head'] = DB::table('project')->where('id', $query->projectid)->first();
        $data['detail'] = DB::table('bast_detail')->where('bastid', $query->id)->get();
        return view('admin.bast.bast_print', $data);
    }


    public function signature_url($id)
    {
        if (!request()->hasValidSignature()) {
            return abort(403);
        }
        $data['cetak'] = Bast::findOrfail($id);
        $query = Bast::findOrfail($id);
        $data['head'] = DB::table('project')->where('id', $query->projectid)->first();
        $data['detail'] = DB::table('bast_detail')->where('bastid', $query->id)->get();
        return view('admin.bast.signature_public', $data);
    }

    public function signature_public($id)
    {
        $data['cetak'] = Bast::findOrfail($id);
        $query = Bast::findOrfail($id);
        $data['head'] = DB::table('project')->where('id', $query->projectid)->first();
        $data['detail'] = DB::table('bast_detail')->where('bastid', $query->id)->get();
        return view('admin.bast.signature_public', $data);
    }

    public function simpan_signature(Request $request, $id, $idsig)
    {
        if ($idsig == 1) {
            if ($request->file('foto') == null) {
                $signature = $request->input('signature1');
                $decode = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));
                $signature_name = 'sign_' . time() . '.png';
                Storage::disk('public')->put($signature_name, $decode);

                $query = Bast::find($id);
                $query->signature1 = $signature_name;
                $query->date_signature1 = Carbon::now()->format('d-m-Y');
                $query->save();
            } else if ($request->file('foto') == true) {
                $bast = Bast::findOrFail($id);
                $bast->signature1 = $request->file('foto')->store('post-image');
                $bast->date_signature1 = Carbon::now()->format('d-m-Y');
                $bast->save();
            }
        } else if ($idsig == 2) {
            if ($request->file('foto') == null) {
                $signature = $request->input('signature2');
                $decode = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));
                $signature_name = 'sign_' . time() . '.png';
                Storage::disk('public')->put($signature_name, $decode);

                $query = Bast::find($id);
                $query->signature2 = $signature_name;
                $query->date_signature2 = Carbon::now()->format('d-m-Y');
                $query->save();
            } else if ($request->file('foto') == true) {
                $bast = Bast::findOrFail($id);
                $bast->signature2 = $request->file('foto')->store('post-image');
                $bast->date_signature2 = Carbon::now()->format('d-m-Y');
                $bast->save();
            }
        }
        return redirect('/signature_public/' . $id)->with('success', 'success');
    }

    public function delete_signature(Request $request, $id, $idsig)
    {
        if ($idsig == 1) {
            $bast = bast::findOrFail($id);
            if ($bast->signature1) {
                Storage::delete($bast->signature1);
            }
            $bast->signature1 = '';
            $bast->date_signature1 = '';
            $bast->save();
        } else if ($idsig == 2) {
            $bast = bast::findOrFail($id);
            if ($bast->signature2) {
                storage::delete($bast->signature2);
            }
            $bast->signature2 = '';
            $bast->date_signature2 = '';
            $bast->save();
        }
        return redirect('/signature_public/' . $id)->with('delete', 'delete');
    }

    public function simpan_detail(Request $request, $id, $bastid)
    {
        if ($request->file('foto') == null) {
            $signature = $request->input('signature3');
            $decode = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));
            $signature_name = 'sign_' . time() . '.png';
            Storage::disk('public')->put($signature_name, $decode);

            $query = Detail::where('id', $id)->where('bastid', $bastid)->first();
            $query->paraf = $signature_name;
            $query->save();
        } else if ($request->file('foto') == true) {
            $detail = Detail::where('id', $id)->where('bastid', $bastid)->first();
            $detail->paraf = $request->file('foto')->store('post-image');
            $detail->save();
        }
        return redirect('/signature_public/' . $bastid)->with('success', 'success');
    }
}
