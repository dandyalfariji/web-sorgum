@extends('layouts.admin')

@section('title', 'Mitra & Partner')

@section('header_action')
    <a href="{{ route('admin.partners.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Partner</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Logo</th>
                    <th>Nama Partner</th>
                    <th>URL Website</th>
                    <th>Status</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                <tr>
                    <td class="px-4">
                        @if($partner->image)
                            <img src="{{ asset('storage/' . $partner->image) }}" class="img-thumbnail" style="height: 40px; width: 70px; object-fit: contain;">
                        @else
                            <span class="text-muted small">No Logo</span>
                        @endif
                    </td>
                    <td><strong>{{ $partner->name }}</strong></td>
                    <td><a href="{{ $partner->url }}" target="_blank" class="text-decoration-none">{{ $partner->url ?? '-' }}</a></td>
                    <td>
                        <span class="badge bg-{{ $partner->is_active ? 'success' : 'secondary' }}">
                            {{ $partner->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus partner ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada mitra/partner.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($partners->hasPages())
    <div class="card-footer bg-white pt-3">{{ $partners->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
