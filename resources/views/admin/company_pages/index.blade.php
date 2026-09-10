@extends('layouts.admin')

@section('title', 'Halaman Perusahaan / About')

@section('header_action')
    <a href="{{ route('admin.company-pages.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Konten</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Gambar</th>
                    <th>Headline</th>
                    <th>Paragraf 1</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companyPages as $page)
                <tr>
                    <td class="px-4">
                        @if($page->image_1)
                            <img src="{{ asset('storage/' . $page->image_1) }}" class="img-thumbnail" style="height: 45px; width: 70px; object-fit: cover;">
                        @else
                            <span class="text-muted small">No Image</span>
                        @endif
                    </td>
                    <td><strong>{{ $page->headline }}</strong></td>
                    <td>{{ Str::limit($page->paragraph_1, 60) }}</td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.company-pages.edit', $page) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.company-pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus konten ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada konten Halaman Perusahaan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($companyPages->hasPages())
    <div class="card-footer bg-white pt-3">{{ $companyPages->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
