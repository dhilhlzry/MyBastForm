<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    use HasFactory;

    protected $table = 'bast_form';

    protected $fillable = [
            'projectid',
            'sprint',
            'bast_no',
            'bast_date',
            'revision',
            'phase',
            'of_number',
            'nama_pihak1',
            'nama_pihak2',
            'perusahaan_pihak1',
            'perusahaan_pihak2',
            'jabatan_pihak1',
            'jabatan_pihak2',
            'alamat_pihak1',
            'alamat_pihak2'
    ];

    public function mom()
    {
        return $this->belongsTo(Mom::class, 'bast', 'id');
    }
}
