@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('header_action')
    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold">Semua Produk</h6>
        <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex" style="width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama/kategori..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td class="px-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <span class="text-muted small">No Image</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong><br>
                        <small class="text-muted">{{ $product->slug }}</small>
                    </td>
                    <td><span class="badge bg-light text-dark border">{{ $product->category ?? 'Umum' }}</span></td>
                    <td><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                        
                        <form action="{{ route('admin.products.toggle', $product) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $product->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} me-1" title="{{ $product->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
                                <i class="bi {{ $product->is_active ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                            </button>
                        </form>

                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white pt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
