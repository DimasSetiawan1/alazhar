<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infaq extends Model
{
    protected $fillable = ['nama_donatur', 'jumlah', 'tanggal', 'no_wa', 'keterangan', 'bukti_transfer', 'status'];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];
}
