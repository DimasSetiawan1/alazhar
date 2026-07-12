@extends('layouts.public')

@section('title', 'Jadwal Sholat | Masjid AL-Azhar')

@section('content')

    <div class="mb-4">
        <h2 style="font-family:'Poppins',sans-serif; color:#3a7bd5;">
            <i class="bi bi-moon-stars-fill me-2"></i>JADWAL SHOLAT
        </h2>
        <p class="text-muted" style="font-family:'Rubik',sans-serif;">
            Kota {{ $kota }} &mdash; {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM YYYY') }}
        </p>

        @if($jadwal)
        <div class="row g-3 mt-1" data-aos="fade-up">
            @php
                $icons = [
                    'Subuh'   => ['bi-sunrise-fill',      '#3a7bd5'],
                    'Dzuhur'  => ['bi-sun-fill',           '#f5a623'],
                    'Ashar'   => ['bi-cloud-sun-fill',     '#e67e22'],
                    'Maghrib' => ['bi-sunset-fill',        '#e74c3c'],
                    'Isya'    => ['bi-moon-fill',          '#2d5895'],
                ];
            @endphp

            @foreach($jadwal as $nama => $waktu)
            @php [$icon, $color] = $icons[$nama]; @endphp
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-center shadow-sm h-100" style="border-top: 4px solid {{ $color }}; border-radius:12px;">
                    <div class="card-body py-4">
                        <i class="bi {{ $icon }}" style="font-size:36px; color:{{ $color }};"></i>
                        <h5 class="mt-2 mb-0 fw-bold" style="font-family:'Poppins',sans-serif; color:#2d5895;">{{ $nama }}</h5>
                        <p class="fs-4 fw-bold mt-1 mb-0" style="font-family:'Poppins',sans-serif; color:#333;">{{ $waktu }}</p>
                        <small class="text-muted">WIB</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="alert mt-4" style="background:#e8f4fd; border-left:4px solid #3a7bd5; font-size:13px;">
            <i class="bi bi-info-circle-fill me-2" style="color:#3a7bd5;"></i>
            Jadwal sholat diambil dari API <strong>aladhan.com</strong> menggunakan metode perhitungan Kemenag Indonesia.
            Waktu dalam WIB (UTC+7). Harap verifikasi dengan jadwal resmi setempat.
        </div>

        @else
        <div class="alert alert-warning" data-aos="fade-up">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Tidak dapat mengambil data jadwal sholat saat ini. Silakan coba lagi nanti.
        </div>
        @endif

        {{-- Jadwal Sholat Mingguan Info --}}
        <div class="card shadow-sm mt-4" data-aos="fade-up">
            <div class="card-header fw-bold" style="background:linear-gradient(to right,#3a7bd5,#00d2ff); color:#fff;">
                <i class="bi bi-calendar3 me-2"></i> Kegiatan Rutin Masjid AL-Azhar
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="color:#2d5895;">Kegiatan</th>
                                <th style="color:#2d5895;">Waktu</th>
                                <th style="color:#2d5895;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:14px;">
                            <tr><td>Sholat Jumat</td><td>11:30 WIB</td><td>Setiap Jumat</td></tr>
                            <tr><td>Pengajian Rutin</td><td>Ba'da Maghrib</td><td>Setiap Ahad</td></tr>
                            <tr><td>Sholat Tahajud Berjamaah</td><td>03:30 WIB</td><td>Setiap Ramadhan</td></tr>
                            <tr><td>Kajian Subuh</td><td>Ba'da Subuh</td><td>Setiap Sabtu</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
