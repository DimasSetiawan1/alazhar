<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use Illuminate\Http\Request;

class InfaqController extends Controller
{
    public function index()
    {
        $infaqs     = Infaq::where('status', 'confirmed')->latest('tanggal')->paginate(10)->onEachSide(1);
        $totalInfaq = Infaq::where('status', 'confirmed')->sum('jumlah');
        return view('home.infaq', compact('infaqs', 'totalInfaq'));
    }

    public function exportPdf()
    {
        $infaqs = Infaq::where('status', 'confirmed')->latest('tanggal')->get();
        $totalInfaq = Infaq::where('status', 'confirmed')->sum('jumlah');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('home.infaq-pdf', compact('infaqs', 'totalInfaq'));
        return $pdf->download('Laporan_Infaq_Al_Azhar.pdf');
    }

    public function konfirmasi(Request $request)
    {
        $request->validate([
            'nama_donatur' => 'required|string|max:100',
            'jumlah'       => 'required|numeric|min:1',
            'tanggal'      => 'required|date',
            'no_wa'        => 'required|string|max:20',
            'keterangan'   => 'nullable|string|max:255',
        ], [
            'jumlah.min' => 'Nominal uang tidak boleh 0, minimal adalah Rp. 1.'
        ]);

        // Simpan data dengan status pending
        Infaq::create([
            'nama_donatur' => $request->nama_donatur,
            'jumlah'       => $request->jumlah,
            'tanggal'      => $request->tanggal,
            'no_wa'        => $request->no_wa,
            'keterangan'   => $request->keterangan,
            'status'       => 'pending',
        ]);

        return back()->with('success', 'Alhamdulillah, konfirmasi infaq berhasil dikirim dan sedang menunggu verifikasi admin. Jazakumullah khairan.');
    }
}
