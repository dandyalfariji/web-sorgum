<?php

namespace App\Livewire;

use App\Models\Header;
use Livewire\Component;
use App\Models\NavigationMenu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HeaderPage extends Component
{
    /** Section aktif di header: home|company|features|team|marketplace */
    public string $active = 'home';

    /** Toggle untuk mobile menu */
    public bool $open = false;

    // Properti untuk menampung data dinamis
    public string $logoUrl = '';
    public Collection $menuItems;

    public function mount(): void
    {
        // // Sinkron awal dari route saat pertama kali render
        // if (request()->routeIs('marketplace')) {
        //     $this->active = 'marketplace';
        // } elseif (!in_array($this->active, ['home','company','features','team','marketplace'])) {
        //     $this->active = 'home';
        // }

        // Ambil data header yang aktif dari database
        // Cache digunakan untuk performa, agar tidak query setiap kali halaman di-load
        $activeHeader = Cache::remember('active_header', now()->addMinutes(60), function () {
            return Header::with('menuItems')->where('is_active', true)->first();
        });

        if ($activeHeader && $activeHeader->logo_path && Storage::disk('public')->exists($activeHeader->logo_path)) {
            // SOLUSI: Menggunakan Storage::url() yang akan membaca APP_URL dari .env
            $this->logoUrl = Storage::url($activeHeader->logo_path);
        } else {
            // Fallback jika tidak ada header, tidak ada logo, atau file tidak ditemukan
            $this->logoUrl = asset('images/sorgummi logo.png'); // Pastikan logo default ini ada
        }

        $this->menuItems = $activeHeader ? $activeHeader->menuItems->where('is_visible', true) : collect();

        // Sinkronisasi state 'active' dari route saat pertama kali render
        $this->syncActiveState();
    }

    public function setActive(string $key): void
    {
        $this->active = $key;
        $this->open = false; // Tutup menu mobile setelah item di-klik
    }

    public function toggleMenu(): void
    {
        $this->open = ! $this->open;
    }

    private function syncActiveState(): void
    {
        // Dapatkan semua key yang valid dari menu
        $validKeys = $this->menuItems->pluck('wire_click_key')->all();

        if (request()->routeIs('marketplace')) {
            $this->active = 'marketplace';
        } elseif (!in_array($this->active, $validKeys)) {
            // Jika key saat ini tidak valid (misal: dari URL yang salah), default ke 'home' atau key pertama
            $this->active = $validKeys[0] ?? 'home';
        }
    }

    
    public function render()
    {
        
        return view('livewire.header-page');
    }
}
