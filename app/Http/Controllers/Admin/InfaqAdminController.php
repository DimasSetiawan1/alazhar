<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infaq;
use Illuminate\Http\Request;

class InfaqAdminController extends Controller
{
    public function index()
    {
        $infaqs = Infaq::latest()->paginate(15);
        $totalInfaq = Infaq::where('status', 'confirmed')->sum('jumlah');
        return view('admin.infaq.index', compact('infaqs', 'totalInfaq'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_donatur'   => 'required|string|max:100',
            'jumlah'         => 'required|numeric|min:1000',
            'tanggal'        => 'required|date',
            'keterangan'     => 'nullable|string|max:255',
            'status'         => 'required|in:pending,confirmed',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'jumlah.min' => 'Nominal uang tidak boleh kurang dari Rp. 1.000.',
            'bukti_transfer.image' => 'Bukti transfer harus berupa gambar.',
            'bukti_transfer.max' => 'Ukuran bukti transfer maksimal 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti_transfer')) {
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        Infaq::create($data);
        return redirect()->route('admin.infaq.index')->with('success', 'Data infaq berhasil ditambahkan!');
    }

    public function confirm(Infaq $infaq)
    {
        $infaq->update(['status' => 'confirmed']);
        return redirect()->route('admin.infaq.index')->with('success', 'Infaq berhasil dikonfirmasi!');
    }

    public function destroy(Infaq $infaq)
    {
        if ($infaq->bukti_transfer) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($infaq->bukti_transfer);
        }
        
        $infaq->delete();
        return redirect()->route('admin.infaq.index')->with('success', 'Data infaq berhasil dihapus!');
    }
}
