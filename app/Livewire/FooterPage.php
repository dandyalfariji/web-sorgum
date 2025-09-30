<?php

namespace App\Livewire;

use App\Models\Footer;
use Livewire\Component;

class FooterPage extends Component
{
    public function render()
    {
        // Ambil data pertama (dan satu-satunya) dari tabel footers
        $footer = Footer::first();

        return view('livewire.footer-page', [
            'footer' => $footer
        ]);
    }
}
