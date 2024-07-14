<?php

namespace App\Http\Controllers;

use App\Models\Mom;
use App\Models\Bast;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\DocumentSet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MomController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:mom-index', ['only' => ['index']]);
        $this->middleware('permission:mom-create', ['only' => ['create']]);
        $this->middleware('permission:mom-edit', ['only' => ['edit']]);
        $this->middleware('permission:mom-delete', ['only' => ['delete']]);
    }
    public function index()
    {
        if (auth()->user()->id === 1) {
            $data = Project::with('users')->get();
        } else {
            $data = Project::whereHas('users', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->with('users')->get();
        }
        return view('admin.mom.index', ['projects' => $data]);
    }




    public function datatable(Request $request)
    {
        if ($request->ajax()) {

            if (auth()->user()->id === 1) {
                $data = Mom::with('Project.users');
                if ($request->input('filter_project')) {
                    $data = Mom::with('Project.users')->where('project', $request->filter_project);
                    if ($request->input('bast_filter')) {
                        $data = Mom::with('Project.users')->where('bast', $request->bast_filter);
                    }
                }
            } else {
                $userId = auth()->user()->id;
                $data = Mom::whereHas('project_user', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->with('Project.users');
                if ($request->input('filter_project')) {
                    $data = Mom::with('Project.users')->where('project', $request->filter_project);
                }
            }
            

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->removeColumn('id')
                ->addColumn('project_name', function (Mom $mom) {
                    $html = '';
                    $html .= $mom->Project ?? '';
                    return $html;
                })
                ->addColumn('no_bast', function (Mom $mom) {
                    $html = '';
                    $html .= $mom->basts->bast_no ?? '';
                    return $html;
                })
                ->addColumn('action', function ($data) {
                    $html = '';
                    $html .= '<a href="' . route('mom.print', $data->id) . '" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Print"><i
                    class="fa fa-print"></i></a>&nbsp;';
                    if (auth()->user()->can('mom-edit')) {
                        $html .= '<a href="' . route('mom.edit', $data->id) . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
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

    public function create(Request $request)
    {
        $selectedproject = $request->project;
        $selectedbast = $request->bast;
        $from = $request->from;
        $data['test'] = '';
        if (auth()->user()->id === 1) {
            $project = Project::all();
            if ($request->from == 'bast' || $from == 'project') {
                $data['bast'] = Bast::where('projectid', $selectedproject)->get();
            }
        } else {
            $project = Project::whereHas('users', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->with('users')->get();
            if ($request->from == 'bast' || $from == 'project') {
                $data['bast'] = Bast::where('projectid', $selectedproject)->get();
            }
        }
        if ($request->from == 'bast' || $from == 'project') {
            return view('admin.mom.create', ['project' => $project, 'p_selected' => $selectedproject, 'b_selected' => $selectedbast, 'from' => $from, 'detail' => 'detail'], $data);
        }
        return view('admin.mom.create', ['project' => $project, 'p_selected' => $selectedproject, 'b_selected' => $selectedbast, 'from' => $from]);
    }

    public function BastbyProject(Request $request)
    {
        $bastItems = Bast::where('projectid', $request->project_id)->get(); // Adjust the model and fields accordingly
        return response()->json($bastItems);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '.' . $extension;
            // $filenametostore = $filename.'_'.time().'.'.$extension;

            Storage::delete('public/', $filename);

            //Upload File
            $request->file('file')->storeAs('public/', $filenametostore);

            // you can save image path below in database
            $path = asset('storage/public/' . $filenametostore);

            echo $path;
            exit;
        }
    }

    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required',
            'location' => 'required',
            'time_awal' => 'required',
            'time_akhir' => 'required',
            'attendance' => 'required',
            'content' => 'required',
        ]);

        $validator['attendance'] = Str::limit($request->attendance, 200);
        $validator['content'] = Str::limit($request->plan, 200);


        Mom::create([
            'title' => $request->title,
            'date' => $request->date,
            'project' => $request->project,
            'bast' => $request->bast,
            'location' => $request->location,
            'time_awal' => $request->time_awal,
            'time_akhir' => $request->time_akhir,
            'attendance' => $validator['attendance'],
            'plan' => $request->input('content')
        ]);

        session()->flash('success', 'Data Saved!');
        if ($request->from == 'project') {
            return redirect()->route('bast.view', $request->p_selected);
        } else {
            return redirect()->route('mom.index');
        }
    }

    public function edit(Request $request)
    {
        $selectedproject = $request->project;
        $selectedbast = $request->bast;
        $from = $request->from;
        $find = mom::where('id', $request->id)->first();
        if (!$find) {
            return redirect()->route('mom.index');
        }

        $project = Project::whereNotIn('id', function ($query) use ($find) {
            $query->select('id')
                ->from('project')
                ->where('name', $find->project);
        })->get();
        $bast = Bast::where('projectid', $find->project)->get();
        $data['edit_date'] = Carbon::parse($find->date)->timezone('Asia/Jakarta')->format('Y-m-d');
        return view('admin.mom.create', ['data' => $find, 'project' => $project, 'bast' => $bast, 'p_selected' => $selectedproject, 'b_selected' => $selectedbast, 'from' => $from], $data);
    }

    public function update(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required',
            'location' => 'required',
            'time_awal' => 'required',
            'time_akhir' => 'required',
            'attendance' => 'required',
            'content' => 'required',
        ]);

        $validator['attendance'] = Str::limit($request->attendance, 200);
        $validator['content'] = Str::limit($request->plan, 200);

        $find = mom::find($request->momid);
        Storage::delete($find->plan);

        if (!$find) {
            return redirect()->route('mom.index', $request->projectid);
        }

        $find->update([
            'title' => $request->title,
            'date' => $request->date,
            'project' => $request->project,
            'bast' => $request->bast,
            'location' => $request->location,
            'time_awal' => $request->time_awal,
            'time_akhir' => $request->time_akhir,
            'attendance' => $validator['attendance'],
            'plan' => $request->input('content')
        ]);

        session()->flash('success', 'Data Updated!');
        $from = $request->from;
        if ($from == 'project') {
            return redirect()->route('bast.view', $request->p_selected);
        } elseif ($from == 'bast') {
            return redirect()->route('bast.detail', $request->b_selected);
        } else {
            return redirect()->route('mom.index');
        }
    }
    
    public function delete($id)
    {
        $query = mom::where('id', $id)->first();
        // Storage::delete('public/',$query->plan);
        $delete = mom::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function print(Request $request)
    {
        $selectedproject = $request->project;
        $selectedbast = $request->bast;
        $from = $request->from;
        $data['set'] = DocumentSet::where('name','mom')->first();
        $data['cetak'] = Mom::findOrfail($request->id);
        $data['waktu'] = Mom::selectRaw('TIMESTAMPDIFF(MINUTE, time_awal, time_akhir) AS selisih')->where('id', $request->id)->first();
        if ($from == 'bast') {
            return view('admin.mom.mom_print',['from' => $from,'p_selected' => $selectedproject,'b_selected' => $selectedbast], $data);
        }
        return view('admin.mom.mom_print',['from' => $from,'p_selected' => $selectedproject], $data);
    }
}
