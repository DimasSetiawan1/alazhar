<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Infaq;
use App\Models\Galeri;
use App\Models\Inventaris;

class HomeController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->take(3)->get();
        $infaqs   = Infaq::where('status', 'confirmed')->latest('tanggal')->take(5)->get();
        $totalInfaq = Infaq::where('status', 'confirmed')->sum('jumlah');
        $galeris  = Galeri::latest()->take(6)->get();
        $inventaris = Inventaris::all();

        return view('home.index', compact('artikels', 'infaqs', 'totalInfaq', 'galeris', 'inventaris'));
    }
}
