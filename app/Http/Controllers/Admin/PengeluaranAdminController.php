<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengeluaranAdminController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::latest('tanggal')->paginate(15);
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        return view('admin.pengeluaran.index', compact('pengeluarans', 'totalPengeluaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan'        => 'required|string|max:255',
            'jumlah'            => 'required|numeric|min:1',
            'tanggal'           => 'required|date',
            'bukti_pengeluaran' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti_pengeluaran')) {
            $data['bukti_pengeluaran'] = $request->file('bukti_pengeluaran')->store('bukti_pengeluaran', 'public');
        }

        Pengeluaran::create($data);
        return redirect()->route('admin.pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan!');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->bukti_pengeluaran) {
            Storage::disk('public')->delete($pengeluaran->bukti_pengeluaran);
        }
        
        $pengeluaran->delete();
        return redirect()->route('admin.pengeluaran.index')->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}
