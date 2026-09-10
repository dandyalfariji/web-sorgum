@extends('layouts.admin')

@section('title', 'Header & Navigasi')

@section('header_action')
    <a href="{{ route('admin.headers.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Header</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Logo</th>
                    <th>Nama Header</th>
                    <th>Menu Items</th>
                    <th>Status</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($headers as $header)
                <tr>
                    <td class="px-4">
                        @if($header->logo_path)
                            <img src="{{ asset('storage/' . $header->logo_path) }}" class="img-thumbnail" style="height: 40px; width: 60px; object-fit: contain;">
                        @else
                            <span class="text-muted small">No Logo</span>
                        @endif
                    </td>
                    <td><strong>{{ $header->name }}</strong></td>
                    <td><span class="badge bg-light text-dark border">{{ $header->menuItems->count() }} item menu</span></td>
                    <td>
                        <span class="badge bg-{{ $header->is_active ? 'success' : 'secondary' }}">
                            {{ $header->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.headers.edit', $header) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.headers.destroy', $header) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus header ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada pengaturan header.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($headers->hasPages())
    <div class="card-footer bg-white pt-3">{{ $headers->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
