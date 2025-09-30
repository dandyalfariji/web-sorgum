<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{

    public Product $product;
    public $mainImage;
    public $activeTab = 'detail';

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->mainImage = $this->product->image;
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
