<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'foto'  => 'required|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'foto'  => $path,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus!');
    }
}
