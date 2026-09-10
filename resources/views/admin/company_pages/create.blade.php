@extends('layouts.admin')

@section('title', 'Tambah Konten Perusahaan')

@section('header_action')
    <a href="{{ route('admin.company-pages.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.company-pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Headline *</label>
                    <input type="text" name="headline" class="form-control @error('headline') is-invalid @enderror" value="{{ old('headline') }}" required>
                    @error('headline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Paragraf 1</label>
                    <textarea name="paragraph_1" rows="5" class="form-control">{{ old('paragraph_1') }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Paragraf 2</label>
                    <textarea name="paragraph_2" rows="5" class="form-control">{{ old('paragraph_2') }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tombol 1 Teks & Link</label>
                    <div class="input-group">
                        <input type="text" name="button_1_text" class="form-control" placeholder="Teks" value="{{ old('button_1_text') }}">
                        <input type="text" name="button_1_link" class="form-control" placeholder="Link" value="{{ old('button_1_link') }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tombol 2 Teks & Link</label>
                    <div class="input-group">
                        <input type="text" name="button_2_text" class="form-control" placeholder="Teks" value="{{ old('button_2_text') }}">
                        <input type="text" name="button_2_link" class="form-control" placeholder="Link" value="{{ old('button_2_link') }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gambar Utama 1</label>
                    <input type="file" name="image_1" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gambar Tambahan 2</label>
                    <input type="file" name="image_2" class="form-control" accept="image/*">
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Konten</button>
            </div>
        </form>
    </div>
</div>
@endsection
