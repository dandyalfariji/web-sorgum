<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompanyPage as Company;

class CompanyPage extends Component
{
    public function render()
    {
       // Ambil data pertama (dan satu-satunya) dari tabel company_pages
        $companyPage = Company::first();

        return view('livewire.company-page', [
            'companyPage' => $companyPage
        ]);
    }
}
