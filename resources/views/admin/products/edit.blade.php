@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('header_action')
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk *</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug *</label>
                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $product->slug) }}" required>
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" rows="5" class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
                
                <div class="col-md-12 mt-4">
                    <h6 class="fw-bold mb-3">Varian Produk (Opsional)</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="variants-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Varian (contoh: Petite Box)</th>
                                    <th width="30%">Harga (Rp)</th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_array(old('variants', $product->variants)))
                                    @foreach(old('variants', $product->variants) as $index => $variant)
                                    <tr>
                                        <td>
                                            <input type="text" name="variants[{{ $index }}][name]" class="form-control form-control-sm" value="{{ $variant['name'] ?? '' }}" required>
                                        </td>
                                        <td>
                                            <input type="number" name="variants[{{ $index }}][price]" class="form-control form-control-sm" value="{{ $variant['price'] ?? '' }}" required min="0">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger remove-variant-btn"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-variant-btn">
                        <i class="bi bi-plus-lg"></i> Tambah Varian
                    </button>
                    <small class="d-block text-muted mt-2">Biarkan kosong jika produk ini tidak memiliki varian.</small>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga (Rp) *</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stok *</label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" required>
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Utama</label>
                        @if($product->image)
                            <div class="mb-2"><img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" style="max-height: 120px;"></div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Galeri Tambahan</label>
                        @if($product->images && count($product->images) > 0)
                            <div class="mb-2 d-flex flex-wrap gap-2">
                                @foreach($product->images as $img)
                                    <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail" style="max-height: 80px; width: auto; object-fit: cover;">
                                @endforeach
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="clear_images" id="clear_images" value="1">
                                <label class="form-check-label text-danger" for="clear_images"><small>Hapus semua gambar galeri lama</small></label>
                            </div>
                        @endif
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted d-block mt-1">Pilih gambar tambahan untuk carousel produk.</small>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Aktifkan Produk</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Produk</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('name').addEventListener('keyup', function() {
        document.getElementById('slug').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
    });

    let variantIndex = document.querySelectorAll('#variants-table tbody tr').length;
    document.getElementById('add-variant-btn').addEventListener('click', function() {
        const tbody = document.querySelector('#variants-table tbody');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <input type="text" name="variants[${variantIndex}][name]" class="form-control form-control-sm" required>
            </td>
            <td>
                <input type="number" name="variants[${variantIndex}][price]" class="form-control form-control-sm" required min="0">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger remove-variant-btn"><i class="bi bi-trash"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
        variantIndex++;
    });

    document.querySelector('#variants-table tbody').addEventListener('click', function(e) {
        if (e.target.closest('.remove-variant-btn')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endpush
