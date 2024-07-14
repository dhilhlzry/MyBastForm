<?php

namespace App\Http\Controllers;

use App\Models\Bast;
use App\Models\Project;
use App\Models\project_user;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:project-index', ['only' => ['index']]);
        $this->middleware('permission:project-create', ['only' => ['create']]);
        $this->middleware('permission:project-edit', ['only' => ['edit']]);
        $this->middleware('permission:project-delete', ['only' => ['delete']]);
    }
    public function index()
    {
        return view('admin.project.index');
    }

    public function datatable(Request $request)
    {
        if (auth()->user()->id === 1) {
            $data = Project::with('users')->get();
        } else {
            $data = Project::whereHas('users', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->with('users')->get();
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('users', function ($project) {
                return $project->users->pluck('name')->implode(' , ');
            })
            ->removeColumn('id')
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($data) {

                $html = '';
                if (auth()->user()->can('bast-index')) {
                    $html = '<a href="' . route('bast.view', $data->id) . '" class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="top" title="Bast"><i class="fa fa-book"></i></a>&nbsp;';
                }
                if (auth()->user()->can('project-edit')) {
                    $html .= '<a href="' . route('project.edit', $data->id) . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                }
                if (auth()->user()->can('project-delete')) {
                    $html .= '<form method="post" action="' . route('project.delete', $data->id) . '" style="display: inline">
             <input type="hidden" name="_token" value="' . csrf_token() . '"><input type="hidden" name="_method" value="delete">
             <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm(\'' . __('Hapus project ini?') . '\')"><i class="fa fa-trash"></i></button>&nbsp;
             </form>';
                }

                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereNotIn('id', function ($query) {
            $query->select('id')
                ->from('users')
                ->where('name', '=', 'superadmin');
        })->where('id', '!=', '1')->get();


        return view('admin.project.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if (sizeof($validator->messages()) > 0) {
            session()->flash('error', 'Bad Request!');
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'type_project' => $request->type_project,
        ]);

        foreach ($request->assign_to as $user) {
            project_user::create([
                'user_id' => $user,
                'project_id' => $project->id
            ]);
        }


        session()->flash('Success', 'Data Saved!');
        return redirect()->route('project.index');
    }

    public function destroy($id)
    {
        $find = Project::find($id);

        if (!$find) {
            return view('admin.project.index');
        }
        DB::transaction(function () use ($find) {
            // Delete the project
            $find->delete();
        });
        session()->flash('Success', 'Data Deleted!');
        return view('admin.project.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $find = Project::with('users')->where('id', $id)->first();

        if (!$find) {
            return redirect()->route('Project.index');
        }
        $users = User::whereNotIn('id', function ($query) {
            $query->select('id')
                ->from('users')
                ->where('name', 'superadmin');
        })->where('id', '!=', 1)->get();
        return view('admin.project.create', ['data' => $find, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type_project' => 'required|string|max:255',
            'assign_to' => 'required|array', // assuming assign_to is an array of user IDs
            'assign_to.*' => 'exists:users,id', // each element in the array should be a valid user ID
        ]);


        $project = Project::find($id);

        if (!$project) {
            return redirect()->route('project.index');
        }
        DB::transaction(function () use ($project, $request, $validatedData) {
            $project->update([
                'name' => $request->name,
                'description' => $request->description,
                'type_project' => $request->type_project,

            ]);

            $project->users()->sync($validatedData['assign_to']);
        });
        session()->flash('Success', 'Data Updated!');
        return redirect()->route('project.index');
    }

    public function validator($request)
    {
        return Validator::make($request->all(), [
            "name" => ["required"],
            "description" => ["required"],
            "type_project" => ["required"],
            "assign_to" => ["required"]
        ]);
    }
}
