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
            'nama_donatur' => 'required|string|max:100',
            'jumlah'       => 'required|numeric|min:0',
            'tanggal'      => 'required|date',
            'keterangan'   => 'nullable|string|max:255',
            'status'       => 'required|in:pending,confirmed',
        ]);

        Infaq::create($request->all());
        return redirect()->route('admin.infaq.index')->with('success', 'Data infaq berhasil ditambahkan!');
    }

    public function confirm(Infaq $infaq)
    {
        $infaq->update(['status' => 'confirmed']);
        return redirect()->route('admin.infaq.index')->with('success', 'Infaq berhasil dikonfirmasi!');
    }

    public function destroy(Infaq $infaq)
    {
        $infaq->delete();
        return redirect()->route('admin.infaq.index')->with('success', 'Data infaq berhasil dihapus!');
    }
}
