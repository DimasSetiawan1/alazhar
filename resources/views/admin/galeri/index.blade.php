@extends('layouts.admin')

@section('title', 'Galeri Foto')
@section('page-title', 'Galeri Foto Masjid')

@section('content')
    <div class="row g-4">
        {{-- Form Upload Foto --}}
        <div class="col-lg-4">
            <div class="content-card">
                <h5><i class="bi bi-cloud-upload me-2"></i>Upload Foto Baru</h5>
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Judul Foto</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}" placeholder="Nama atau deskripsi foto" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">File Foto</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" required>
                        <div class="form-text text-muted">Format: JPG, PNG. Maks 3MB.</div>
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="bi bi-upload me-1"></i> Upload Foto
                    </button>
                </form>
            </div>
        </div>

        {{-- Grid Galeri --}}
        <div class="col-lg-8">
            <div class="content-card">
                <h5><i class="bi bi-images me-2"></i>Foto Galeri ({{ $galeris->total() }})</h5>
                <div class="row g-3">
                    @forelse($galeris as $foto)
                    <div class="col-sm-6 col-md-4">
                        <div class="card shadow-sm border-0" style="border-radius:12px; overflow:hidden;">
                            <div style="height:150px; overflow:hidden;">
                                <img src="{{ asset('storage/'.$foto->foto) }}" alt="{{ $foto->judul }}"
                                     style="width:100%; height:100%; object-fit:cover; transition:transform 0.3s;"
                                     onmouseover="this.style.transform='scale(1.05)'"
                                     onmouseout="this.style.transform='scale(1)'">
                            </div>
                            <div class="card-body p-2">
                                <p class="mb-1" style="font-size:12px; font-weight:600; color:#2d5895;">{{ Str::limit($foto->judul, 25) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $foto->created_at->format('d-m-Y') }}</small>
                                    <form action="{{ route('admin.galeri.destroy', $foto) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus foto ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger p-1" style="line-height:1;">
                                            <i class="bi bi-trash-fill" style="font-size:11px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="bi bi-images" style="font-size:48px; color:#3a7bd5;"></i>
                        <p class="mt-2">Belum ada foto. Upload foto pertama!</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-3">{{ $galeris->links() }}</div>
            </div>
        </div>
    </div>
@endsection
