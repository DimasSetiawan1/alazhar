<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('home.artikel', compact('artikel'));
    }
}
