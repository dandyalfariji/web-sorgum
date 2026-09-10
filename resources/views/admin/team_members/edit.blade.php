@extends('layouts.admin')

@section('title', 'Edit Anggota Tim')

@section('header_action')
    <a href="{{ route('admin.team-members.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teamMember->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jabatan / Role</label>
                    <input type="text" name="role" class="form-control" value="{{ old('role', $teamMember->role) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Instagram URL</label>
                    <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $teamMember->instagram_url) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $teamMember->linkedin_url) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Foto Profil</label>
                    @if($teamMember->photo)
                        <div class="mb-2"><img src="{{ asset('storage/' . $teamMember->photo) }}" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;"></div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Urutan (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $teamMember->sort_order) }}">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $teamMember->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Aktifkan Anggota Tim Ini</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Anggota Tim</button>
            </div>
        </form>
    </div>
</div>
@endsection
