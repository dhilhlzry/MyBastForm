<?php

namespace App\Http\Controllers;

// use App\Models\Role as ModelsRole;

use App\Models\Role as ModelsRole;
use App\Services\Role\IRoleService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Config::get('permission_list');
        $role = Role::all();
        // dd($role);
        return view('admin.roles.index', ['permissions' => $permissions,'role' => $role]);
    }

    public $role;
    function __construct(IRoleService $role)
    {
        $this->middleware('permission:role-index', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create']]);
        $this->middleware('permission:role-edit', ['only' => ['edit']]);
        $this->middleware('permission:role-delete', ['only' => ['delete']]);
        $this->role = $role;
    }


    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::query()->where('id', '!=', '1')->with('permissions')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($data) {
                    $html = '';
                    if (auth()->user()->can('role-edit')) {
                        // $html .= '<a href="' . route('roles.edit', $data->id) . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                        $html .= '<button type="button" class="btn btn-primary btn-xs edit" data-toggle="modal" data-target="#Edit'.$data->id.'" data-id="'.$data->id.'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>';
                    }
                    if (auth()->user()->can('role-delete')) {
                        $html .= '<form method="post" action="' . route('roles.delete', $data->id) . '" style="display: inline">
                <input type="hidden" name="_token" value="' . csrf_token() . '"><input type="hidden" name="_method" value="delete">
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm(\'' . __('Yakin Ingin Menghapus Role Ini ?') . '\')"><i class="fa fa-trash"></i></button>&nbsp;
                </form>';
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Config::get('permission_list');
        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->role->StoreRole($request);
            session()->flash('success', 'Data Saved!');
            return redirect()->route('roles.index');
        } catch (ValidationException $e) {
            session()->flash('error', 'Bad Request!');
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $find = Role::find($id);
        $permissions = Config::get('permission_list');
        if (!$find) {
            return redirect()->route('roles.index');
        }
        // return view('admin.roles.create', ['find' => $find, 'permissions' => $permissions]);
        return response()->json(['role'=> $find,'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->role->UpdateRole($request, $id);
            session()->flash('success', 'Data Updated!');
            return redirect()->route('roles.index');
        } catch (ValidationException $e) {
            session()->flash('error', 'Bad Request!');
            return redirect()->back()->withInput()->withErrors($e->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->role->DeleteRole($id);
            session()->flash('success', 'Data Deleted!');
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('roles.index');
        }
    }

    public function validator($request)
    {
        return Validator::make($request->all(), [
            "name" => ["required"],
        ]);
    }

    public function addPermissionToRole($Id)
    {

        return view('admin.roles.create');
    }
    public function givePermissionToRole(Request $request, $Id)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($Id);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions added to role');
    }
}
