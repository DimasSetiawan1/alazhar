@extends('layouts.public')

@section('title', 'Laporan Keuangan | Masjid AL-Azhar')

@section('content')

    <div class="customLInfaq mb-4">
        <h2>LAPORAN KEUANGAN</h2>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header text-center fw-bold" style="background:#d1e7dd; color:#0f5132;">
                        Total Pemasukan (Infaq)
                    </div>
                    <div class="card-body">
                        <h4 class="text-center fw-bold text-success">
                            Rp. {{ number_format($totalInfaq, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header text-center fw-bold" style="background:#f8d7da; color:#842029;">
                        Total Pengeluaran
                    </div>
                    <div class="card-body">
                        <h4 class="text-center fw-bold text-danger">
                            Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header text-center fw-bold" style="background:linear-gradient(to right,#3a7bd5,#00d2ff); color:#fff;">
                        Saldo Saat Ini
                    </div>
                    <div class="card-body">
                        <h4 class="text-center fw-bold" style="color:#2d5895;">
                            Rp. {{ number_format($saldo, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" data-aos="fade-up">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold" style="background:#f8f9fa; color:#2d5895;">
                        <i class="bi bi-table me-2"></i> Riwayat Pengeluaran
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Bukti (Opsional)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengeluarans as $pengeluaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengeluaran->keterangan }}</td>
                                        <td>Rp. {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ $pengeluaran->tanggal->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if($pengeluaran->bukti_pengeluaran)
                                                <a href="{{ asset('storage/' . $pengeluaran->bukti_pengeluaran) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    Lihat
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">Belum ada data pengeluaran.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3 overflow-auto" style="white-space: nowrap;">
                            {{ $pengeluarans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
