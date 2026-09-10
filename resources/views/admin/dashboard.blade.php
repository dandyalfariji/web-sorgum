@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<!-- Stats Widget Grid -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card p-3 border-0 shadow-sm text-center">
            <div class="text-primary mb-1 fs-3"><i class="bi bi-file-earmark-text-fill"></i></div>
            <h4 class="fw-bold mb-0">{{ $stats['articles_count'] }}</h4>
            <span class="text-muted small">Total Artikel</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card p-3 border-0 shadow-sm text-center">
            <div class="text-success mb-1 fs-3"><i class="bi bi-bag-check-fill"></i></div>
            <h4 class="fw-bold mb-0">{{ $stats['products_count'] }}</h4>
            <span class="text-muted small">Total Produk</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card p-3 border-0 shadow-sm text-center">
            <div class="text-info mb-1 fs-3"><i class="bi bi-handbag-fill"></i></div>
            <h4 class="fw-bold mb-0">{{ $stats['partners_count'] }}</h4>
            <span class="text-muted small">Total Partner</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card p-3 border-0 shadow-sm text-center">
            <div class="text-warning mb-1 fs-3"><i class="bi bi-people-fill"></i></div>
            <h4 class="fw-bold mb-0">{{ $stats['team_count'] }}</h4>
            <span class="text-muted small">Anggota Tim</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card p-3 border-0 shadow-sm text-center">
            <div class="text-danger mb-1 fs-3"><i class="bi bi-stars"></i></div>
            <h4 class="fw-bold mb-0">{{ $stats['features_count'] }}</h4>
            <span class="text-muted small">Fitur Keunggulan</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card p-3 border-0 shadow-sm text-center">
            <div class="text-secondary mb-1 fs-3"><i class="bi bi-badge-ad-fill"></i></div>
            <h4 class="fw-bold mb-0">{{ $stats['hero_count'] }}</h4>
            <span class="text-muted small">Hero Banners</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Articles -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold m-0"><i class="bi bi-file-earmark-text text-primary me-2"></i>Artikel Terbaru</h6>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($recent_articles as $article)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div>
                                <span class="fw-semibold d-block text-truncate" style="max-width: 280px;">{{ $article->title }}</span>
                                <small class="text-muted">{{ $article->created_at ? $article->created_at->diffForHumans() : '-' }}</small>
                            </div>
                            <span class="badge bg-{{ $article->status == 'Published' ? 'success' : 'warning text-dark' }}">{{ $article->status }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center py-4 text-muted">Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold m-0"><i class="bi bi-bag-check text-success me-2"></i>Produk Terbaru</h6>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($recent_products as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div>
                                <span class="fw-semibold d-block text-truncate" style="max-width: 280px;">{{ $product->name }}</span>
                                <small class="text-muted">Rp {{ number_format($product->price, 0, ',', '.') }} | Stok: {{ $product->stock }}</small>
                            </div>
                            <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center py-4 text-muted">Belum ada produk.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
