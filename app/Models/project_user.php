<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_user extends Model
{
    protected $table = 'project_user';
    protected $fillable = ['user_id', 'project_id'];
    public $timestamps = false;
    use HasFactory;
}
