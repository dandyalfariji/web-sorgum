@extends('layouts.admin')

@section('title', 'Edit Hero Banner')

@section('header_action')
    <a href="{{ route('admin.hero-sections.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<form action="{{ route('admin.hero-sections.update', $heroSection) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="fw-bold m-0">Informasi Utama Banner</h6>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Referensi Banner *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $heroSection->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Headline</label>
                    <input type="text" name="headline" class="form-control" value="{{ old('headline', $heroSection->headline) }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $heroSection->description) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tombol Utama Text & URL</label>
                    <div class="input-group">
                        <input type="text" name="primary_button_text" class="form-control" value="{{ old('primary_button_text', $heroSection->primary_button_text) }}">
                        <input type="text" name="primary_button_url" class="form-control" value="{{ old('primary_button_url', $heroSection->primary_button_url) }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tombol Sekunder Text & URL</label>
                    <div class="input-group">
                        <input type="text" name="secondary_button_text" class="form-control" value="{{ old('secondary_button_text', $heroSection->secondary_button_text) }}">
                        <input type="text" name="secondary_button_url" class="form-control" value="{{ old('secondary_button_url', $heroSection->secondary_button_url) }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gambar Banner Utama</label>
                    @if($heroSection->hero_image_path)
                        <div class="mb-2"><img src="{{ asset('storage/' . $heroSection->hero_image_path) }}" class="img-thumbnail" style="max-height: 100px;"></div>
                    @endif
                    <input type="file" name="hero_image_path" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6 mb-3 align-self-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $heroSection->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Set Sebagai Active Banner</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="fw-bold m-0">Mid Section & CTA Banner (Opsional)</h6>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Mid Section Headline</label>
                    <input type="text" name="mid_section_headline" class="form-control" value="{{ old('mid_section_headline', $heroSection->mid_section_headline) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Mid Section Gambar</label>
                    @if($heroSection->mid_section_image_path)
                        <div class="mb-2"><img src="{{ asset('storage/' . $heroSection->mid_section_image_path) }}" class="img-thumbnail" style="max-height: 100px;"></div>
                    @endif
                    <input type="file" name="mid_section_image_path" class="form-control" accept="image/*">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Mid Section Deskripsi</label>
                    <textarea name="mid_section_description" rows="2" class="form-control">{{ old('mid_section_description', $heroSection->mid_section_description) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">CTA Headline</label>
                    <input type="text" name="cta_headline" class="form-control" value="{{ old('cta_headline', $heroSection->cta_headline) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">CTA Button Text & URL</label>
                    <div class="input-group">
                        <input type="text" name="cta_button_text" class="form-control" value="{{ old('cta_button_text', $heroSection->cta_button_text) }}">
                        <input type="text" name="cta_button_url" class="form-control" value="{{ old('cta_button_url', $heroSection->cta_button_url) }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">CTA Gambar</label>
                    @if($heroSection->cta_image_path)
                        <div class="mb-2"><img src="{{ asset('storage/' . $heroSection->cta_image_path) }}" class="img-thumbnail" style="max-height: 100px;"></div>
                    @endif
                    <input type="file" name="cta_image_path" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">
        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Banner Hero</button>
    </div>
</form>
@endsection
