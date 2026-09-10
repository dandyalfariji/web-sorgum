@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('header_action')
    <a href="{{ route('admin.partners.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Partner / Perusahaan *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $partner->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">URL Website Partner</label>
                    <input type="url" name="url" class="form-control" value="{{ old('url', $partner->url) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Logo Partner</label>
                    @if($partner->image)
                        <div class="mb-2"><img src="{{ asset('storage/' . $partner->image) }}" class="img-thumbnail" style="max-height: 80px;"></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6 mb-3 align-self-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Aktifkan Partner Ini</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Partner</button>
            </div>
        </form>
    </div>
</div>
@endsection
