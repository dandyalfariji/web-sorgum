@extends('layouts.admin')

@section('title', 'Tambah Pengaturan Footer')

@section('header_action')
    <a href="{{ route('admin.footers.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.footers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Brand / Perusahaan *</label>
                    <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" value="{{ old('brand_name') }}" required>
                    @error('brand_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Logo Footer</label>
                    <input type="file" name="logo_path" class="form-control" accept="image/*">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Copyright Text</label>
                    <input type="text" name="copyright_text" class="form-control" value="{{ old('copyright_text') }}" placeholder="© 2026 Sorgumology. All Rights Reserved.">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">WhatsApp Link</label>
                    <input type="text" name="whatsapp_url" class="form-control" value="{{ old('whatsapp_url') }}" placeholder="https://wa.me/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Instagram Link</label>
                    <input type="text" name="instagram_url" class="form-control" value="{{ old('instagram_url') }}" placeholder="https://instagram.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">TikTok Link</label>
                    <input type="text" name="tiktok_url" class="form-control" value="{{ old('tiktok_url') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Shopee Link</label>
                    <input type="text" name="shopee_url" class="form-control" value="{{ old('shopee_url') }}">
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Footer</button>
            </div>
        </form>
    </div>
</div>
@endsection
