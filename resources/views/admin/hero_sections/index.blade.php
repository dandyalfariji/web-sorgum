@extends('layouts.admin')

@section('title', 'Hero Banners')

@section('header_action')
    <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Banner Baru
    </a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Gambar</th>
                    <th>Nama Banner</th>
                    <th>Headline</th>
                    <th>Status</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($heroSections as $hero)
                <tr>
                    <td class="px-4">
                        @if($hero->hero_image_path)
                            <img src="{{ asset('storage/' . $hero->hero_image_path) }}" class="img-thumbnail" style="width: 70px; height: 45px; object-fit: cover;">
                        @else
                            <span class="text-muted small">No Image</span>
                        @endif
                    </td>
                    <td><strong>{{ $hero->name }}</strong></td>
                    <td>{{ Str::limit($hero->headline, 40) }}</td>
                    <td>
                        <span class="badge bg-{{ $hero->is_active ? 'success' : 'secondary' }}">
                            {{ $hero->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.hero-sections.edit', $hero) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.hero-sections.destroy', $hero) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus banner ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada banner Hero.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($heroSections->hasPages())
    <div class="card-footer bg-white pt-3">
        {{ $heroSections->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
