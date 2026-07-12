@extends('layouts.public')

@section('title', 'Masjid AL-Azhar | Beranda')

@section('content')

    {{-- JUMBOTRON --}}
    <div class="p-5 mb-4 rounded-3 shadow-lg customJumbtron" data-aos="fade-right">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Masjid | AL - Azhar</h1>
            <p class="col-md-8 fs-5"><strong>DONASIKAN WAKAF TERBAIK ANDA KE MASJID AL AZHAR</strong></p>
            <a href="{{ route('home') }}#dokumen" class="btn btn-light btn-md fw-bold me-2" style="color: #2d5895;">
                <i class="bi bi-file-earmark-fill"></i> Lihat Proposal
            </a>
            <a href="https://goo.gl/maps/a8Ku7kwRomxPV1nS8" target="_blank" rel="noopener noreferrer"
               class="btn btn-light btn-md fw-bold" style="color: #2d5895;">
                <i class="bi bi-geo-alt-fill"></i> Lokasi
            </a>
        </div>
    </div>

    {{-- INFORMASI --}}
    <div class="customInformasi mb-4" id="informasi">
        <h2>INFORMASI</h2>
        <div class="row">
            @forelse($artikels as $artikel)
            <div class="col-md-6 col-sm-4 col-lg-4" data-aos="flip-left">
                <div class="card mb-3 shadow-sm p-2">
                    <div class="row g-0">
                        <div class="col-md-5">
                            @if($artikel->thumbnail)
                                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" class="card-img" height="150px" style="object-fit:cover; border-radius:4px;" alt="{{ $artikel->judul }}">
                            @else
                                <div style="height:150px; background: linear-gradient(to right, #3a7bd5, #00d2ff); border-radius:4px; display:flex; align-items:center; justify-content:center;">
                                    <i class="bi bi-newspaper text-white" style="font-size:40px;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title fs-6 fw-bold">
                                    <a href="{{ route('artikel.show', $artikel->id) }}" style="text-decoration: none; color: #2d5895;">
                                        {{ Str::limit($artikel->judul, 40) }}
                                    </a>
                                </h5>
                                <p class="card-text" style="color: #7c7c7c; font-size: 13px;">
                                    {{ Str::limit(strip_tags($artikel->konten), 80) }}...
                                </p>
                                <p class="card-text">
                                    <small style="color: #7c7c7c; font-size: 13px;">{{ $artikel->created_at->format('Y-m-d') }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted">Belum ada informasi tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- LAPORAN INFAQ --}}
    <div class="customLInfaq mb-4" id="infaq">
        <h2>LAPORAN INFAQ</h2>
        <div class="row">
            <div class="col-lg-6" data-aos="flip-down">
                <div class="card mb-4">
                    <div class="card-header text-center fw-bold" style="background: linear-gradient(to right,#3a7bd5,#00d2ff); color:#fff;">
                        Dana Terkumpul
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center" style="color:#2d5895;">
                            Saldo : Rp. {{ number_format($totalInfaq, 0, ',', '.') }}
                        </h4>
                        <p class="text-muted text-center">
                            Salurkan infaq Anda melalui rekening berikut<br>
                            Bank Syariah Indonesia (BSI) — <span class="fw-bold">1029762062</span><br>
                            A/n Masjid AL Azhar
                        </p>
                        <div class="text-center">
                            <a href="{{ route('infaq.index') }}" class="btn btn-sm" style="background:#3a7bd5; color:#fff;">
                                <i class="bi bi-cash-coin"></i> Konfirmasi Infaq
                            </a>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Dana saat ini ada di Bank Syariah Indonesia (BSI)
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="flip-down">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Oleh</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($infaqs as $infaq)
                            <tr>
                                <td>{{ $infaq->nama_donatur }}</td>
                                <td>Rp. {{ number_format($infaq->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $infaq->tanggal->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data infaq.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('infaq.export-pdf') }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-danger text-light me-1" style="text-decoration: none;">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i> Save Data
                    </a>
                    <a href="{{ route('infaq.index') }}" class="btn btn-sm text-light" style="background-color: #3a7bd5;">
                        <i class="bi bi-arrow-clockwise"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- INVENTARIS BARANG --}}
    <div class="customInformasi mb-4" id="inventaris">
        <h2>INVENTARIS MASJID</h2>
        <div class="row">
            <div class="col-12" data-aos="fade-up">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold" style="background:#f8f9fa; color:#2d5895;">
                        <i class="bi bi-box-seam me-2"></i> Daftar Inventaris Barang
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0">
                                <thead style="background-color: #f2f2f2;">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Kondisi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($inventaris as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $item->nama_barang }}</td>
                                        <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                                        <td>
                                            @if($item->kondisi === 'baik')
                                                <span class="badge bg-success">Baik</span>
                                            @elseif($item->kondisi === 'rusak ringan')
                                                <span class="badge bg-warning text-dark">Rusak Ringan</span>
                                            @else
                                                <span class="badge bg-danger">Rusak Berat</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada data inventaris.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GALERI --}}
    <div class="customGaleri mb-4" id="galeri">
        <h2 class="text-center">GALERI</h2>
        <div class="row">
            @forelse($galeris as $foto)
            <div class="col-sm-6 col-md-6 col-lg-4 imageThumbnail" data-aos="zoom-in">
                <a href="{{ asset('storage/' . $foto->foto) }}" target="_blank" rel="noopener noreferrer">
                    <img class="shadow" src="{{ asset('storage/' . $foto->foto) }}" alt="{{ $foto->judul }}">
                </a>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-4">
                <i class="bi bi-images" style="font-size:48px; color:#3a7bd5;"></i>
                <p class="mt-2">Belum ada foto galeri.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- DOKUMEN --}}
    <div class="customDownloads mb-5" id="dokumen">
        <h2>DOKUMEN</h2>
        <div class="list-dokumen" data-aos="fade-right">
            <div class="list-group text-capitalize">
                <a href="{{ asset('storage/Proposal Pembangunan Renovasi Al Azhar 2022 Final.pdf') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="list-group-item list-group-item-action"
                   style="font-size:14px; color:#585858;">
                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                    Proposal Pembangunan Renovasi Al Azhar 2022 Final
                    <span class="badge ms-2" style="background:#3a7bd5; font-size:11px;">PDF</span>
                </a>
            </div>
        </div>
    </div>

@endsection
