@extends('layouts.admin')

@section('title', 'Edit Inventaris')
@section('page-title', 'Edit Barang Inventaris')

@section('content')
    <div class="content-card" style="max-width:600px;">
        <h5><i class="bi bi-pencil-fill me-2"></i>Edit Barang: {{ $inventaris->nama_barang }}</h5>
        <form action="{{ route('admin.inventaris.update', $inventaris) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
                       value="{{ old('nama_barang', $inventaris->nama_barang) }}" required>
                @error('nama_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $inventaris->kategori) }}">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                           value="{{ old('jumlah', $inventaris->jumlah) }}" min="1" required>
                    @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Satuan</label>
                    <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror"
                           value="{{ old('satuan', $inventaris->satuan) }}" required>
                    @error('satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Kondisi</label>
                <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
                    <option value="baik" {{ old('kondisi', $inventaris->kondisi) === 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak ringan" {{ old('kondisi', $inventaris->kondisi) === 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak berat" {{ old('kondisi', $inventaris->kondisi) === 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('kondisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold" style="font-family:'Poppins',sans-serif; font-size:14px; color:#2d5895;">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $inventaris->keterangan) }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-save me-1"></i> Update</button>
                <a href="{{ route('admin.inventaris.index') }}" class="btn btn-outline-secondary" style="border-radius:8px; font-family:'Poppins',sans-serif; font-size:14px;">Batal</a>
            </div>
        </form>
    </div>
@endsection
