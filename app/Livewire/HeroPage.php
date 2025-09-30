<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HeroSection;
use Illuminate\Support\Facades\Cache;

class HeroPage extends Component
{
    public ?HeroSection $heroData = null;

    public function mount()
    {
        // Ambil data hero section yang aktif dari database, gunakan cache untuk performa
        $this->heroData = Cache::remember('active_hero_section', now()->addMinutes(60), function () {
            return HeroSection::where('is_active', true)->first();
        });
    }
    public function render()
    {
        return view('livewire.hero-page');
    }
}
