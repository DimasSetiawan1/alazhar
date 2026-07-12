@extends('layouts.admin')

@section('title', 'Kelola Infaq')
@section('page-title', 'Kelola Infaq')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="content-card" style="border-left:4px solid #00b09b;">
                <div class="stat-label">Total Infaq Terkumpul (Dikonfirmasi)</div>
                <div class="stat-number mt-1">Rp. {{ number_format($totalInfaq, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Tabel Infaq --}}
        <div class="col-lg-8">
            <div class="content-card">
                <h5><i class="bi bi-cash-stack me-2"></i>Daftar Infaq</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Donatur</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>No. WA</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($infaqs as $infaq)
                            <tr>
                                <td>{{ $infaqs->firstItem() + $loop->index }}</td>
                                <td class="fw-bold">{{ $infaq->nama_donatur }}</td>
                                <td>Rp. {{ number_format($infaq->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $infaq->tanggal->format('d-m-Y') }}</td>
                                <td>
                                    @if($infaq->no_wa)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $infaq->no_wa) }}" target="_blank" class="text-success">
                                            <i class="bi bi-whatsapp me-1"></i>{{ $infaq->no_wa }}
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($infaq->status === 'confirmed')
                                        <span class="badge-confirmed">Dikonfirmasi</span>
                                    @else
                                        <span class="badge-pending">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($infaq->status === 'pending')
                                    <form action="{{ route('admin.infaq.confirm', $infaq) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-outline-success" title="Konfirmasi">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('admin.infaq.destroy', $infaq) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data infaq.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $infaqs->links() }}
            </div>
        </div>

        {{-- Form Tambah Infaq Manual --}}
        <div class="col-lg-4">
            <div class="content-card">
                <h5><i class="bi bi-plus-circle me-2"></i>Tambah Data Infaq</h5>
                <form action="{{ route('admin.infaq.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px; font-weight:600; color:#2d5895;">Nama Donatur</label>
                        <input type="text" name="nama_donatur" class="form-control form-control-sm @error('nama_donatur') is-invalid @enderror"
                               value="{{ old('nama_donatur') }}" required>
                        @error('nama_donatur')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                        <label class="form-label" style="font-size:13px; font-weight:600; color:#2d5895;">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control form-control-sm" value="{{ old('keterangan') }}" placeholder="opsional">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px; font-weight:600; color:#2d5895;">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="confirmed">Dikonfirmasi</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100"><i class="bi bi-save me-1"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelector('input[name="jumlah"]').addEventListener('input', function(e) {
        if (this.value !== '' && parseFloat(this.value) <= 0) {
            alert('Peringatan: Nominal uang tidak boleh 0, minimal adalah Rp. 1.');
            this.value = '';
        }
    });
</script>
@endpush
