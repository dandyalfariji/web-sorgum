<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('category', 'like', "%{$request->search}%");
        }
        $products = $query->orderBy('is_active', 'desc')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');
        
        if (isset($data['variants']) && is_array($data['variants'])) {
            $data['variants'] = array_values(array_filter($data['variants'], function($variant) {
                return !empty($variant['name']) && isset($variant['price']);
            }));
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product-images', 'public');
        }

        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                $uploadedImages[] = $file->store('product-images/gallery', 'public');
            }
            $data['images'] = $uploadedImages;
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if (isset($data['variants']) && is_array($data['variants'])) {
            $data['variants'] = array_values(array_filter($data['variants'], function($variant) {
                return !empty($variant['name']) && isset($variant['price']);
            }));
        } else {
            $data['variants'] = null;
        }

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('product-images', 'public');
        }

        $existingImages = $product->images ?? [];
        if ($request->filled('clear_images') && $request->clear_images == '1') {
            foreach ($existingImages as $oldImg) {
                if (Storage::disk('public')->exists($oldImg)) {
                    Storage::disk('public')->delete($oldImg);
                }
            }
            $existingImages = [];
        }

        if ($request->hasFile('images')) {
            $newImages = [];
            foreach ($request->file('images') as $file) {
                $newImages[] = $file->store('product-images/gallery', 'public');
            }
            $data['images'] = array_merge($existingImages, $newImages);
        } else {
            $data['images'] = $existingImages;
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        if (!empty($product->images)) {
            foreach ($product->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function toggle(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        $status = $product->is_active ? 'ditampilkan' : 'disembunyikan';
        return redirect()->route('admin.products.index')->with('success', "Produk berhasil $status.");
    }
}
