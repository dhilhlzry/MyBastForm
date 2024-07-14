<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDeleteRequest;
use App\Mail\SampleEmail;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules;
use App\Mail\SendMail;
use App\Mail\sendPassword;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator as ValidationValidator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    function __construct()
    {
        $this->middleware('permission:user-index', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create']]);
        $this->middleware('permission:user-edit', ['only' => ['edit']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }



    public function datatable(Request $request)
    {
        $data = User::with('role')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->removeColumn('id')
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
            })
            ->editColumn('status', function ($data) {
                $status = ($data->status ? 'Active' : 'Inactive');
                $class = ($data->status ? 'badge-success' : 'badge-danger');
                return "<span class=\"badge $class\">$status</span>";
            })

            ->addColumn('action', function ($data) {
                $html = '';

                if ($data->id === 1) {
                    $html .= '<form method="post" action="' . route('user.delete', $data->id) . '" style="display: none">
                                <input type="hidden" name="_token" value="' . csrf_token() . '"><input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm(\'' . __('Hapus hak akses ini?') . '\')"><i class="fa fa-trash"></i></button>&nbsp;
                                </form>';
                    $html .= '<a href="' . route('user.edit', $data->id) . '" style="display: none"';
                } else {
                    if (auth()->user()->can('user-edit')) {
                        $html .= '<a href="' . route('user.edit', $data->id) . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if(auth()->user()->can('user-delete')){
                    $html .= '<form method="post" action="' . route('user.delete', $data->id) . '" style="display: inline">
                    <input type="hidden" name="_token" value="' . csrf_token() . '"><input type="hidden" name="_method" value="delete">
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm(\'' . __('Yakin Ingin Menghapus User Ini ?') . '\')"><i class="fa fa-trash"></i></button>&nbsp;
                    </form>';
                }
                }
                return $html;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', '1')->get();
       
        return view('admin.user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'nip' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'role_id' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'Bad Request');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $password = Str::random(8);
        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);
        $user = User::where('name', $request->name)->first();
        $role = Role::where('id', $request->role_id)->first();
        $user->assignRole($role->name);
        Mail::to($request->email)->send(new sendPassword($password));
        session()->flash('Success', 'Data Saved!');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $find = User::find($id);

        if (!$find) {
            return redirect()->route('user.index');
        }

        $roles = Role::where('id','!=',1)->get();

        return view('admin.user.create', ['data' => $find, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'Bad Request');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $find = User::find($id);

        if (!$find) {
            return redirect()->route('user.index');
        }
        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $find->password;
        }

        $find->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);
        $roles = Role::find($request->role_id);
        $find->syncRoles($roles->name);
        session()->flash('Success', 'Data Updated!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = User::find($id);

        if (!$find) {
            return redirect()->route('user.index');
        }


        $find->delete();

        session()->flash('Success', 'Data Deleted!');
        return redirect()->route('user.index');
    }

    public function validator($request)
    {


        if ($request->method() == "POST") {
            $rules['password'] = ["required", "confirmed", Rules\Password::defaults()];
            $rules['email'] = ["required", "email", Rule::unique('users')];

            $id = 1;
            $rules = [
                'name' => ['required', 'unique:users,name,' . $id . ',id'],
                'role_id' => ['required'],
                'nip' => ['required', 'unique:users,id'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ];
        }


        if ($request->method() == "PUT") {
            $user = User::find($request->id);
            $rules['password'] = ["confirmed"];
            $rules['email'] = ["required", "email", Rule::unique('users')->ignore($user->id)];
        }
        return Validator::make($request->all(), $rules);
    }
}
