<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyPageRequest;
use App\Models\CompanyPage;
use Illuminate\Support\Facades\Storage;

class CompanyPageController extends Controller
{
    public function index()
    {
        $companyPages = CompanyPage::latest()->paginate(10);
        return view('admin.company_pages.index', compact('companyPages'));
    }

    public function create()
    {
        return view('admin.company_pages.create');
    }

    public function store(CompanyPageRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_1')) {
            $data['image_1'] = $request->file('image_1')->store('company-images', 'public');
        }
        if ($request->hasFile('image_2')) {
            $data['image_2'] = $request->file('image_2')->store('company-images', 'public');
        }

        CompanyPage::create($data);
        return redirect()->route('admin.company-pages.index')->with('success', 'Konten Perusahaan berhasil ditambahkan.');
    }

    public function edit(CompanyPage $companyPage)
    {
        return view('admin.company_pages.edit', compact('companyPage'));
    }

    public function update(CompanyPageRequest $request, CompanyPage $companyPage)
    {
        $data = $request->validated();

        if ($request->hasFile('image_1')) {
            if ($companyPage->image_1 && Storage::disk('public')->exists($companyPage->image_1)) {
                Storage::disk('public')->delete($companyPage->image_1);
            }
            $data['image_1'] = $request->file('image_1')->store('company-images', 'public');
        }
        if ($request->hasFile('image_2')) {
            if ($companyPage->image_2 && Storage::disk('public')->exists($companyPage->image_2)) {
                Storage::disk('public')->delete($companyPage->image_2);
            }
            $data['image_2'] = $request->file('image_2')->store('company-images', 'public');
        }

        $companyPage->update($data);
        return redirect()->route('admin.company-pages.index')->with('success', 'Konten Perusahaan berhasil diperbarui.');
    }

    public function destroy(CompanyPage $companyPage)
    {
        if ($companyPage->image_1 && Storage::disk('public')->exists($companyPage->image_1)) {
            Storage::disk('public')->delete($companyPage->image_1);
        }
        if ($companyPage->image_2 && Storage::disk('public')->exists($companyPage->image_2)) {
            Storage::disk('public')->delete($companyPage->image_2);
        }
        $companyPage->delete();
        return redirect()->route('admin.company-pages.index')->with('success', 'Konten Perusahaan berhasil dihapus.');
    }
}
