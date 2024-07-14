<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentSet extends Model
{
    use HasFactory;

    protected $table = 'settingdoc';

    protected $fillable = [
        'name',
        'margin_y',
        'margin_x',
        'col1_mt',
        'col2_mt',
        'col3_mt',
        'col4_mt',
    ];
}
