@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

@section('content')
    <div class="content-card">
        <h5><i class="bi bi-pencil-fill me-2"></i>Edit Artikel</h5>
        <form action="{{ route('admin.artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Judul Artikel</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul', $artikel->judul) }}" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Thumbnail (Foto)</label>
                @if($artikel->thumbnail)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$artikel->thumbnail) }}" height="80" style="border-radius:8px;">
                        <small class="text-muted ms-2">Foto saat ini</small>
                    </div>
                @endif
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</div>
                @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Isi Artikel</label>
                <textarea name="konten" class="form-control @error('konten') is-invalid @enderror"
                          rows="12" required>{{ old('konten', $artikel->konten) }}</textarea>
                @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-save me-1"></i> Update</button>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary" style="border-radius:8px; font-family:'Poppins',sans-serif; font-size:14px;">Batal</a>
            </div>
        </form>
    </div>
@endsection
