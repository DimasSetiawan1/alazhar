@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card" style="border-left-color:#00b09b;">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:linear-gradient(to right,#00b09b,#96c93d);"><i class="bi bi-box-arrow-in-down"></i></div>
                    <div>
                        <div class="stat-number" style="font-size:18px;">Rp. {{ number_format($totalInfaq, 0, ',', '.') }}</div>
                        <div class="stat-label">Total Pemasukan (Infaq)</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card" style="border-left-color:#e74c3c;">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:linear-gradient(to right,#e74c3c,#c0392b);"><i class="bi bi-box-arrow-up"></i></div>
                    <div>
                        <div class="stat-number" style="font-size:18px;">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                        <div class="stat-label">Total Pengeluaran</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card" style="border-left-color:#3a7bd5;">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:linear-gradient(to right,#3a7bd5,#00d2ff);"><i class="bi bi-wallet2"></i></div>
                    <div>
                        <div class="stat-number" style="font-size:18px;">Rp. {{ number_format($saldo, 0, ',', '.') }}</div>
                        <div class="stat-label">Saldo Saat Ini</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card" style="border-left-color:#f5a623;">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:linear-gradient(to right,#f5a623,#f9d423);"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <div class="stat-number">{{ $pendingInfaq }}</div>
                        <div class="stat-label">Infaq Pending</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Infaq Terbaru --}}
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="bi bi-cash-coin me-2"></i>Infaq Terbaru</h5>
                    <a href="{{ route('admin.infaq.index') }}" class="btn btn-sm btn-primary-custom">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Donatur</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($infaqTerbaru as $infaq)
                            <tr>
                                <td>{{ $infaq->nama_donatur }}</td>
                                <td class="fw-bold">Rp. {{ number_format($infaq->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $infaq->tanggal->format('d-m-Y') }}</td>
                                <td>
                                    @if($infaq->status === 'confirmed')
                                        <span class="badge-confirmed">Dikonfirmasi</span>
                                    @else
                                        <span class="badge-pending">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data infaq.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Akses Cepat --}}
        <div class="col-lg-4">
            <div class="content-card">
                <h5><i class="bi bi-lightning-charge me-2"></i>Akses Cepat</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary-custom text-start">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Artikel
                    </a>
                    <a href="{{ route('admin.infaq.index') }}" class="btn btn-outline-warning text-start" style="font-family:'Poppins',sans-serif; font-size:14px; border-radius:8px;">
                        <i class="bi bi-check-circle me-2"></i> Konfirmasi Infaq Pending
                        @if($pendingInfaq > 0)
                            <span class="badge bg-danger ms-1">{{ $pendingInfaq }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.inventaris.create') }}" class="btn btn-outline-secondary text-start" style="font-family:'Poppins',sans-serif; font-size:14px; border-radius:8px;">
                        <i class="bi bi-plus-square me-2"></i> Tambah Inventaris
                    </a>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-info text-start" style="font-family:'Poppins',sans-serif; font-size:14px; border-radius:8px;">
                        <i class="bi bi-image-fill me-2"></i> Kelola Galeri
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-success text-start" style="font-family:'Poppins',sans-serif; font-size:14px; border-radius:8px;">
                        <i class="bi bi-globe me-2"></i> Lihat Website Publik
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
