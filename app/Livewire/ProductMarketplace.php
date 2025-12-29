<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductMarketplace extends Component
{
    use WithPagination;

    //Search
    public string $searchInput = '';
    public string $search = '';

    //Category
    public array $categories = [];
    public string $selectedCategory = 'all';

    //Per page
    public int $perPage = 12;

    public function mount()
    {
        $this->categories = Product::query()
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();
    }

    /** Klik tombol Cari */
    public function applySearch(): void
    {
        $this->search = trim($this->searchInput);
        $this->resetPage();
    }

    public function setPerPage(int $n): void
    {
        $this->perPage = max(6, min(48, $n));
        $this->resetPage();
    }

    //tombol kategori
    public function setCategory(string $category)
    {
        $this->selectedCategory = $category;
        $this->resetPage();
    }


    public function render()
    {
        $query = Product::query();

        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }

        if ($this->search !== '') {
            $q = "%{$this->search}%";
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', $q)
                    ->orWhere('slug', 'like', $q)
                    ->orWhere('category', 'like', $q)
                    ->orWhere('description', 'like', $q);
            });
        }

        $products = $query->where('is_active', true)
            ->latest()->paginate($this->perPage);

        return view('livewire.product-marketplace', [
            'products' => $products,
        ]);
    }
}
