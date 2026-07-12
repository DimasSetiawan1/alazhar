<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelAdminController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'konten'    => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['judul', 'konten']);
        $data['created_by'] = 'Admin';

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikels', 'public');
        }

        Artikel::create($data);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'konten'    => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['judul', 'konten']);

        if ($request->hasFile('thumbnail')) {
            if ($artikel->thumbnail) {
                Storage::disk('public')->delete($artikel->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('artikels', 'public');
        }

        $artikel->update($data);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->thumbnail) {
            Storage::disk('public')->delete($artikel->thumbnail);
        }
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
