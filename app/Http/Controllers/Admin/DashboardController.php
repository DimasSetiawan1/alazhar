<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Infaq;
use App\Models\Inventaris;
use App\Models\Galeri;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArtikel    = Artikel::count();
        $totalInfaq      = Infaq::where('status', 'confirmed')->sum('jumlah');
        $pendingInfaq    = Infaq::where('status', 'pending')->count();
        $totalInventaris = Inventaris::count();
        $totalGaleri     = Galeri::count();

        $infaqTerbaru = Infaq::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalArtikel', 'totalInfaq', 'pendingInfaq',
            'totalInventaris', 'totalGaleri', 'infaqTerbaru'
        ));
    }
}
