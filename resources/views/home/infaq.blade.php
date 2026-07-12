@extends('layouts.public')

@section('title', 'Infaq | Masjid AL-Azhar')

@section('content')

    <div class="customLInfaq mb-4">
        <h2>INFAQ & DONASI</h2>

        <div class="row">
            {{-- Info Rekening + Form Konfirmasi --}}
            <div class="col-lg-5 mb-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header text-center fw-bold" style="background:linear-gradient(to right,#3a7bd5,#00d2ff); color:#fff;">
                        Dana Terkumpul
                    </div>
                    <div class="card-body">
                        <h4 class="text-center fw-bold" style="color:#2d5895;">
                            Rp. {{ number_format($totalInfaq, 0, ',', '.') }}
                        </h4>
                        <p class="text-muted text-center">
                            Salurkan infaq Anda melalui rekening berikut<br>
                            <strong>Bank Syariah Indonesia (BSI)</strong><br>
                            No. Rek: <strong>1029762062</strong><br>
                            A/n Masjid AL Azhar
                        </p>
                    </div>
                    <div class="card-footer text-muted text-center" style="font-size:13px;">
                        Dana saat ini ada di Bank Syariah Indonesia (BSI)
                    </div>
                </div>

                {{-- Form Konfirmasi Bayar --}}
                <div class="card shadow-sm" data-aos="fade-up">
                    <div class="card-header fw-bold" style="background:#f8f9fa; color:#2d5895;">
                        <i class="bi bi-whatsapp text-success me-2"></i> Konfirmasi Pembayaran via WhatsApp
                    </div>
                    <div class="card-body">
                        <p class="text-muted" style="font-size:13px;">
                            Isi form berikut untuk konfirmasi infaq Anda. Setelah submit, Anda akan diarahkan ke WhatsApp koordinator.
                        </p>
                        <form action="{{ route('infaq.konfirmasi') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="font-size:14px;">Nama Donatur</label>
                                <input type="text" name="nama_donatur" class="form-control @error('nama_donatur') is-invalid @enderror"
                                       placeholder="Nama Anda" value="{{ old('nama_donatur') }}" required>
                                @error('nama_donatur')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="font-size:14px;">Jumlah Infaq (Rp)</label>
                                <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                       placeholder="Contoh: 500000" value="{{ old('jumlah') }}" min="1000" required>
                                @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="font-size:14px;">Tanggal Transfer</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="font-size:14px;">Nomor WhatsApp</label>
                                <input type="text" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror"
                                       placeholder="628xxxxxxxxx" value="{{ old('no_wa') }}" required>
                                @error('no_wa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="font-size:14px;">Keterangan (opsional)</label>
                                <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Infaq Jumat minggu ini">{{ old('keterangan') }}</textarea>
                            </div>
                            <button type="submit" class="btn w-100 fw-bold" style="background:linear-gradient(to right,#3a7bd5,#00d2ff); color:#fff; border:none;">
                                <i class="bi bi-whatsapp me-2"></i> Kirim Konfirmasi via WhatsApp
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Kontak Koordinator --}}
                <div class="card shadow-sm mt-3">
                    <div class="card-header fw-bold" style="background:#f8f9fa; color:#2d5895;">
                        <i class="bi bi-person-lines-fill me-2"></i> Koordinator Infaq
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush" style="font-size:14px;">
                            <li class="list-group-item">Bpk. Eko Pramono, SE &mdash; <strong>0811-1972-250</strong></li>
                            <li class="list-group-item">Bpk. H. Hari Subagjo, MM &mdash; <strong>0878-7937-3989</strong></li>
                            <li class="list-group-item">Bpk. Ir. H. Ashari &mdash; <strong>0814-1006-9554</strong></li>
                            <li class="list-group-item">Suyanti, SE &mdash; <strong>0819-3257-7824</strong></li>
                            <li class="list-group-item">Budi Santoso, ST &mdash; <strong>0852-8964-4605</strong></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Tabel Laporan Infaq --}}
            <div class="col-lg-7" data-aos="fade-left">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold" style="background:#f8f9fa; color:#2d5895;">
                        <i class="bi bi-table me-2"></i> Riwayat Infaq
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Oleh</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($infaqs as $infaq)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $infaq->nama_donatur }}</td>
                                        <td>Rp. {{ number_format($infaq->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ $infaq->tanggal->format('d-m-Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada data infaq.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3 overflow-auto" style="white-space: nowrap;">
                            {{ $infaqs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
