<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{

    public Product $product;
    public $mainImage;
    public $activeTab = 'detail';
    public $selectedVariantIndex = null;
    public $currentPrice = 0;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->mainImage = $this->product->image;
        $this->currentPrice = $this->product->price;

        if (is_array($this->product->variants) && count($this->product->variants) > 0) {
            $this->selectedVariantIndex = 0;
            $this->currentPrice = $this->product->variants[0]['price'];
        }
    }

    public function updatedSelectedVariantIndex($value)
    {
        if ($value !== null && isset($this->product->variants[$value])) {
            $this->currentPrice = $this->product->variants[$value]['price'];
            
            // Ubah gambar berdasarkan varian (indeks 0 = gambar utama, indeks > 0 = gambar galeri)
            if ($value == 0) {
                $this->mainImage = $this->product->image;
            } elseif (is_array($this->product->images) && isset($this->product->images[$value - 1])) {
                $this->mainImage = $this->product->images[$value - 1];
            }
        }
    }

    public function changeImage($image)
    {
        $this->mainImage = $image;
    }
    public function render()
    {
        return view('livewire.product-detail');
    }
}
