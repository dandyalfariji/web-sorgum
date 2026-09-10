<?php

namespace App\Observers;

use App\Models\HeroSection;

use Illuminate\Support\Facades\Cache;

class HeroSectionObserver
{
    /**
     * Handle the HeroSection "created" event.
     */
    public function created(HeroSection $heroSection): void
    {
        Cache::forget('active_hero_section');
    }

    /**
     * Handle the HeroSection "updated" event.
     */
    public function updated(HeroSection $heroSection): void
    {
        Cache::forget('active_hero_section');
    }

    /**
     * Handle the HeroSection "deleted" event.
     */
    public function deleted(HeroSection $heroSection): void
    {
        Cache::forget('active_hero_section');
    }

    /**
     * Handle the HeroSection "restored" event.
     */
    public function restored(HeroSection $heroSection): void
    {
        //
    }

    /**
     * Handle the HeroSection "force deleted" event.
     */
    public function forceDeleted(HeroSection $heroSection): void
    {
        //
    }
}
