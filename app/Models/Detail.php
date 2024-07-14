<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'bast_detail';

    protected $fillable = [
        'bastid',
        'fitur',
        'deskripsi',
        'penguji',
        'tanggaluji',
        'paraf'
    ];
}
