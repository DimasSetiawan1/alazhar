<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Infaq;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::latest('tanggal')->paginate(10)->onEachSide(1);
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $totalInfaq = Infaq::where('status', 'confirmed')->sum('jumlah');
        $saldo = $totalInfaq - $totalPengeluaran;

        return view('home.pengeluaran', compact('pengeluarans', 'totalPengeluaran', 'totalInfaq', 'saldo'));
    }
}
