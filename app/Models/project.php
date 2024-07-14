<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'project';
    protected $fillable = [
        'name',
        'description',
        'type_project',
        'assign_to',

    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'assign_to');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
    public function mom()
    {
        return $this->belongsTo(Mom::class, 'project', 'id');
    }
    public function basts(){
        return $this->hasMany(Bast::class);
    }
}
