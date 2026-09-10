@extends('layouts.admin')

@section('title', 'Edit Fitur Keunggulan')

@section('header_action')
    <a href="{{ route('admin.features.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.features.update', $feature) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Judul Fitur *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $feature->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Ikon (Nama Bootstrap Icon)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-{{ $feature->icon ?? 'star' }}"></i></span>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $feature->icon) }}">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi Fitur</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $feature->description) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $feature->sort_order) }}">
                </div>
                <div class="col-md-6 mb-3 align-self-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $feature->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Aktifkan Fitur Ini</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Fitur</button>
            </div>
        </form>
    </div>
</div>
@endsection
