<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::latest()->paginate(15);
        return view('admin.inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        return view('admin.inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:150',
            'kategori'    => 'nullable|string|max:100',
            'jumlah'      => 'required|integer|min:1',
            'satuan'      => 'required|string|max:50',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
            'keterangan'  => 'nullable|string|max:500',
        ]);

        Inventaris::create($request->all());
        return redirect()->route('admin.inventaris.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Inventaris $inventaris)
    {
        return view('admin.inventaris.edit', compact('inventaris'));
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:150',
            'kategori'    => 'nullable|string|max:100',
            'jumlah'      => 'required|integer|min:1',
            'satuan'      => 'required|string|max:50',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
            'keterangan'  => 'nullable|string|max:500',
        ]);

        $inventaris->update($request->all());
        return redirect()->route('admin.inventaris.index')->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();
        return redirect()->route('admin.inventaris.index')->with('success', 'Barang berhasil dihapus!');
    }
}
