<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $fillable = ['nama_barang', 'kategori', 'jumlah', 'satuan', 'kondisi', 'keterangan'];

    protected $table = 'inventaris';
}
