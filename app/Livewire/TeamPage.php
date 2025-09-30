<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TeamMember;

class TeamPage extends Component
{
    public function render()
    {
        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
            
        return view('livewire.team-page', [
            'teamMembers' => $teamMembers
        ]);
    }
}
