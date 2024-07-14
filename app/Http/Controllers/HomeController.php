<?php

namespace App\Http\Controllers;

use App\Models\Mom;
use App\Models\Project as ModelsProject;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    // function __construct(){
    //     $this->middleware('permission:dashboard-index', ['only' => ['index']]);
    //     $this->middleware('permission:dashboard-create', ['only' => ['create']]);
    //     $this->middleware('permission:dashboard-edit', ['only' => ['edit']]);
    //     $this->middleware('permission:dashboard-delete', ['only' => ['delete']]);
    // }
    public function index(){
        $data['user'] = User::all()->count();
        $data['role'] = Role::all()->count();
        // $data['project'] = ModelsProject::all()->count();
        if (auth()->user()->id === 1) {
            $data['project'] = ModelsProject::all()->count();
        } else {
            $data['project'] = ModelsProject::whereHas('users', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->with('users')->count();
        }
        if (auth()->user()->id === 1) {
            $data['mom'] = Mom::all()->count();
        } else {
            $userId = auth()->user()->id;
            $data['mom'] = Mom::whereHas('project_user', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->with('Project.users')->count();
        }
        return view('admin.index', $data);
    }
}
