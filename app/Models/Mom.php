<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mom extends Model
{
    use HasFactory;

    protected $table = 'mom';

    protected $fillable = [
        'title',
        'date',
        'project',
        'bast',
        'location',
        'time_awal',
        'time_akhir',
        'attendance',
        'plan'
    ];

    public function Project(){
        return $this->belongsTo(Project::class,'project','id');
    }
    public function project_user(){
        return $this->hasOne(project_user::class,'project_id','project');
    }
    public function basts(){
        return $this->belongsTo(Bast::class,'bast','id');
    }
}
