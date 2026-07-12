@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('page-title', 'Artikel / Informasi')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="bi bi-newspaper me-2"></i>Daftar Artikel</h5>
            <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle me-1"></i> Tambah Artikel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Dibuat Oleh</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikels as $artikel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($artikel->thumbnail)
                                <img src="{{ asset('storage/'.$artikel->thumbnail) }}" width="60" height="45" style="object-fit:cover; border-radius:6px;">
                            @else
                                <div style="width:60px; height:45px; background:linear-gradient(to right,#3a7bd5,#00d2ff); border-radius:6px; display:flex; align-items:center; justify-content:center;">
                                    <i class="bi bi-newspaper text-white"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ Str::limit($artikel->judul, 50) }}</td>
                        <td>{{ $artikel->created_by }}</td>
                        <td>{{ $artikel->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('artikel.show', $artikel->id) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Lihat">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('admin.artikel.edit', $artikel) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('admin.artikel.destroy', $artikel) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada artikel.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $artikels->links() }}
    </div>
@endsection
