<?php

namespace App\Livewire;

use App\Models\Feature;
use Livewire\Component;
use App\Models\FeatureSection;
use Illuminate\Support\Facades\Cache;

class FeaturesPage extends Component
{
    public function render()
    {
        // Mengambil semua fitur yang aktif dan mengurutkannya berdasarkan sort_order
        $features = Feature::where('is_active', true)
                            ->orderBy('sort_order', 'asc')
                            ->get();

        return view('livewire.features-page', [
            'features' => $features
        ]);
    }
}
