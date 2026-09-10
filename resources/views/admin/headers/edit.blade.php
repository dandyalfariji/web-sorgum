@extends('layouts.admin')

@section('title', 'Edit Header Navigasi')

@section('header_action')
    <a href="{{ route('admin.headers.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.headers.update', $header) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Header *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $header->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Logo Website</label>
                    @if($header->logo_path)
                        <div class="mb-2"><img src="{{ asset('storage/' . $header->logo_path) }}" class="img-thumbnail" style="max-height: 60px;"></div>
                    @endif
                    <input type="file" name="logo_path" class="form-control" accept="image/*">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $header->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Aktifkan Header Ini</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Header</button>
            </div>
        </form>
    </div>
</div>

<!-- Registered Menu Items -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h6 class="fw-bold m-0"><i class="bi bi-list me-1"></i> Item Menu Navigasi</h6>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Urutan</th>
                    <th>Label Menu</th>
                    <th>URL Link</th>
                </tr>
            </thead>
            <tbody>
                @forelse($header->menuItems as $item)
                <tr>
                    <td class="px-4"><span class="badge bg-light text-dark border">{{ $item->order }}</span></td>
                    <td><strong>{{ $item->label }}</strong></td>
                    <td><span class="text-muted">{{ $item->url }}</span></td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada item menu navigasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
