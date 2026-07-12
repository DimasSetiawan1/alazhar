@extends('layouts.admin')

@section('title', 'Tambah Artikel')
@section('page-title', 'Tambah Artikel')

@section('content')
    <div class="content-card">
        <h5><i class="bi bi-plus-circle me-2"></i>Tambah Artikel Baru</h5>
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Judul Artikel</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul') }}" placeholder="Masukkan judul artikel..." required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Thumbnail (Foto)</label>
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                <div class="form-text text-muted">Format: JPG, PNG. Maks 2MB.</div>
                @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Isi Artikel</label>
                <textarea name="konten" id="konten" class="form-control @error('konten') is-invalid @enderror"
                          rows="12" placeholder="Isi artikel..." required>{{ old('konten') }}</textarea>
                @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary" style="border-radius:8px; font-family:'Poppins',sans-serif; font-size:14px;">Batal</a>
            </div>
        </form>
    </div>
@endsection
