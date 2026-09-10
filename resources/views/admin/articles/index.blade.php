@extends('layouts.admin')

@section('title', 'Daftar Artikel')

@section('header_action')
    <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Artikel
    </a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold">Data Artikel</h6>
        <form action="{{ route('admin.articles.index') }}" method="GET" class="d-flex" style="width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari judul/slug..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Thumbnail</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tgl Publish</th>
                    <th class="text-center px-4" width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                <tr>
                    <td class="px-4">
                        @if ($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail" class="img-thumbnail" style="height: 50px; width: 75px; object-fit: cover;">
                        @else
                            <span class="text-muted small">Tanpa Gambar</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $article->title }}</strong><br>
                        <small class="text-muted">{{ $article->slug }}</small>
                    </td>
                    <td>
                        <span class="badge bg-{{ $article->status == 'Published' ? 'success' : 'warning text-dark' }}">
                            {{ $article->status }}
                        </span>
                    </td>
                    <td>
                        {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                    </td>
                    <td class="text-center px-4">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Data artikel belum ada atau tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($articles->hasPages())
    <div class="card-footer bg-white pt-3">
        {{ $articles->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
