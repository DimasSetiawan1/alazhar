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
            'nama_donatur'   => 'required|string|max:100',
            'jumlah'         => 'required|numeric|min:1000',
            'tanggal'        => 'required|date',
            'no_wa'          => 'required|string|min:10|max:15|regex:/^[0-9\-\+\(\)]+$/',
            'keterangan'     => 'nullable|string|max:255',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'jumlah.min' => 'Nominal uang tidak boleh kurang dari Rp. 1.000.',
            'no_wa.min' => 'Nomor WhatsApp terlalu pendek (minimal 10 karakter).',
            'no_wa.max' => 'Nomor WhatsApp terlalu panjang (maksimal 15 karakter).',
            'no_wa.regex' => 'Format nomor WhatsApp tidak valid.',
            'bukti_transfer.required' => 'Bukti transfer wajib diunggah.',
            'bukti_transfer.image' => 'Bukti transfer harus berupa gambar.',
            'bukti_transfer.max' => 'Ukuran bukti transfer maksimal 2MB.',
        ]);

        $buktiTransferPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        // Simpan data dengan status pending
        Infaq::create([
            'nama_donatur'   => $request->nama_donatur,
            'jumlah'         => $request->jumlah,
            'tanggal'        => $request->tanggal,
            'no_wa'          => $request->no_wa,
            'keterangan'     => $request->keterangan,
            'bukti_transfer' => $buktiTransferPath,
            'status'         => 'pending',
        ]);

        return back()->with('success', 'Alhamdulillah, konfirmasi infaq berhasil dikirim dan sedang menunggu verifikasi admin. Jazakumullah khairan.');
    }
}
