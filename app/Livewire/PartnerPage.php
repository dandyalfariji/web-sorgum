<?php

namespace App\Livewire;

use App\Models\Partner;
use Livewire\Component;

class PartnerPage extends Component
{
    public function render()
    {
        $partners = Partner::where('is_active', true)->get();
        return view('livewire.partner-page', [
            'partners' => $partners
        ]);
    }
}
