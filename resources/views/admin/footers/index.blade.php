@extends('layouts.admin')

@section('title', 'Footer Settings')

@section('header_action')
    <a href="{{ route('admin.footers.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Footer</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Logo</th>
                    <th>Nama Brand</th>
                    <th>Copyright Text</th>
                    <th>Sosial Media</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($footers as $footer)
                <tr>
                    <td class="px-4">
                        @if($footer->logo_path)
                            <img src="{{ asset('storage/' . $footer->logo_path) }}" class="img-thumbnail" style="height: 40px; width: 60px; object-fit: contain;">
                        @else
                            <span class="text-muted small">No Logo</span>
                        @endif
                    </td>
                    <td><strong>{{ $footer->brand_name }}</strong></td>
                    <td>{{ Str::limit($footer->copyright_text, 40) }}</td>
                    <td>
                        @if($footer->whatsapp_url)<i class="bi bi-whatsapp text-success me-1"></i>@endif
                        @if($footer->instagram_url)<i class="bi bi-instagram text-danger me-1"></i>@endif
                        @if($footer->tiktok_url)<i class="bi bi-tiktok me-1"></i>@endif
                        @if($footer->shopee_url)<i class="bi bi-bag-fill text-warning me-1"></i>@endif
                    </td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.footers.edit', $footer) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.footers.destroy', $footer) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus footer ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada pengaturan footer.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($footers->hasPages())
    <div class="card-footer bg-white pt-3">{{ $footers->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
