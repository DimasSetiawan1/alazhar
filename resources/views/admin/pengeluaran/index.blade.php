@extends('layouts.admin')

@section('title', 'Kelola Pengeluaran')
@section('page-title', 'Kelola Pengeluaran')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="content-card" style="border-left:4px solid #e74c3c;">
                <div class="stat-label">Total Pengeluaran</div>
                <div class="stat-number mt-1 text-danger">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Tabel Pengeluaran --}}
        <div class="col-lg-8">
            <div class="content-card">
                <h5><i class="bi bi-wallet2 me-2"></i>Daftar Pengeluaran</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengeluarans as $pengeluaran)
                            <tr>
                                <td>{{ $pengeluarans->firstItem() + $loop->index }}</td>
                                <td class="fw-bold">{{ $pengeluaran->keterangan }}</td>
                                <td>Rp. {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $pengeluaran->tanggal->format('d-m-Y') }}</td>
                                <td>
                                    @if($pengeluaran->bukti_pengeluaran)
                                        <a href="{{ asset('storage/' . $pengeluaran->bukti_pengeluaran) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat Bukti">
                                            <i class="bi bi-image"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.pengeluaran.destroy', $pengeluaran) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pengeluaran.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $pengeluarans->links() }}
            </div>
        </div>

        {{-- Form Tambah Pengeluaran --}}
        <div class="col-lg-4">
            <div class="content-card">
                <h5><i class="bi bi-plus-circle me-2"></i>Catat Pengeluaran</h5>
                <form action="{{ route('admin.pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px; font-weight:600; color:#2d5895;">Keterangan / Judul</label>
                        <input type="text" name="keterangan" class="form-control form-control-sm @error('keterangan') is-invalid @enderror"
                               value="{{ old('keterangan') }}" required>
                        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px; font-weight:600; color:#2d5895;">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control form-control-sm @error('jumlah') is-invalid @enderror"
                               value="{{ old('jumlah') }}" min="1" required>
                        @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px; font-weight:600; color:#2d5895;">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control form-control-sm @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px; font-weight:600; color:#2d5895;">Bukti / Nota (Opsional)</label>
                        <input type="file" name="bukti_pengeluaran" class="form-control form-control-sm @error('bukti_pengeluaran') is-invalid @enderror" accept="image/*">
                        @error('bukti_pengeluaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100"><i class="bi bi-save me-1"></i> Simpan Pengeluaran</button>
                </form>
            </div>
        </div>
    </div>
@endsection
