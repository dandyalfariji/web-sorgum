@extends('layouts.admin')

@section('title', 'Fitur Keunggulan')

@section('header_action')
    <a href="{{ route('admin.features.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Fitur</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Ikon</th>
                    <th>Judul Fitur</th>
                    <th>Deskripsi</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($features as $feature)
                <tr>
                    <td class="px-4"><i class="bi bi-{{ $feature->icon ?? 'star' }} fs-4 text-primary"></i></td>
                    <td><strong>{{ $feature->title }}</strong></td>
                    <td>{{ Str::limit($feature->description, 50) }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $feature->sort_order ?? 0 }}</span></td>
                    <td>
                        <span class="badge bg-{{ $feature->is_active ? 'success' : 'secondary' }}">
                            {{ $feature->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.features.edit', $feature) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus fitur ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada fitur keunggulan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($features->hasPages())
    <div class="card-footer bg-white pt-3">{{ $features->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
