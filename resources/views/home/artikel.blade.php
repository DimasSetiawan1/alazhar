@extends('layouts.public')

@section('title', $artikel->judul . ' | Masjid AL-Azhar')
@section('meta_description', Str::limit(strip_tags($artikel->konten), 160))

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#3a7bd5;">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($artikel->judul, 60) }}</li>
        </ol>
    </nav>

    <div class="artikel p-2" style="font-family:'Outfit', sans-serif;">
        <div class="title mb-4">
            <h1 class="fw-bold" style="font-family:'Poppins',sans-serif; color:#2d5895;">{{ $artikel->judul }}</h1>
            <span class="text-muted" style="font-size:14px;">
                <i class="bi bi-calendar3 me-1"></i> {{ $artikel->created_at->format('Y-m-d') }},
                <i class="bi bi-person-fill me-1 ms-2"></i> {{ $artikel->created_by }}
            </span>
        </div>

        @if($artikel->thumbnail)
        <div class="thumbnail mb-4 text-center">
            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" class="img-thumbnail" style="max-width:600px; width:100%;" alt="{{ $artikel->judul }}">
        </div>
        @endif

        <div class="content">
            {!! $artikel->konten !!}
        </div>

        <hr>
        <a href="{{ route('home') }}" class="btn btn-sm buttonCustom">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

@endsection
