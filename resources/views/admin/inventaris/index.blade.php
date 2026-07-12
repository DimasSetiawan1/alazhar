@extends('layouts.admin')

@section('title', 'Inventaris Barang')
@section('page-title', 'Inventaris Barang Masjid')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.inventaris.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-1"></i> Tambah Barang
        </a>
    </div>

    <div class="content-card">
        <h5><i class="bi bi-box-seam me-2"></i>Daftar Inventaris</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Kondisi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventaris as $item)
                    <tr>
                        <td>{{ $inventaris->firstItem() + $loop->index }}</td>
                        <td class="fw-bold">{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori ?? '—' }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>
                            @if($item->kondisi === 'baik')
                                <span class="badge-confirmed">Baik</span>
                            @elseif($item->kondisi === 'rusak ringan')
                                <span class="badge-pending">Rusak Ringan</span>
                            @else
                                <span style="background:#f8d7da; color:#842029; font-size:12px; padding:4px 10px; border-radius:20px;">Rusak Berat</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($item->keterangan, 30) ?? '—' }}</td>
                        <td>
                            <a href="{{ route('admin.inventaris.edit', $item) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('admin.inventaris.destroy', $item) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus barang ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data inventaris.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $inventaris->links() }}
    </div>
@endsection
