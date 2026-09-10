<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroSectionRequest;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::latest()->paginate(10);
        return view('admin.hero_sections.index', compact('heroSections'));
    }

    public function create()
    {
        return view('admin.hero_sections.create');
    }

    public function store(HeroSectionRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('hero_image_path')) {
            $data['hero_image_path'] = $request->file('hero_image_path')->store('hero-images', 'public');
        }
        if ($request->hasFile('mid_section_image_path')) {
            $data['mid_section_image_path'] = $request->file('mid_section_image_path')->store('hero-images', 'public');
        }
        if ($request->hasFile('cta_image_path')) {
            $data['cta_image_path'] = $request->file('cta_image_path')->store('hero-images', 'public');
        }

        HeroSection::create($data);
        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section berhasil ditambahkan.');
    }

    public function edit(HeroSection $heroSection)
    {
        return view('admin.hero_sections.edit', compact('heroSection'));
    }

    public function update(HeroSectionRequest $request, HeroSection $heroSection)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('hero_image_path')) {
            if ($heroSection->hero_image_path && Storage::disk('public')->exists($heroSection->hero_image_path)) {
                Storage::disk('public')->delete($heroSection->hero_image_path);
            }
            $data['hero_image_path'] = $request->file('hero_image_path')->store('hero-images', 'public');
        }

        if ($request->hasFile('mid_section_image_path')) {
            if ($heroSection->mid_section_image_path && Storage::disk('public')->exists($heroSection->mid_section_image_path)) {
                Storage::disk('public')->delete($heroSection->mid_section_image_path);
            }
            $data['mid_section_image_path'] = $request->file('mid_section_image_path')->store('hero-images', 'public');
        }

        if ($request->hasFile('cta_image_path')) {
            if ($heroSection->cta_image_path && Storage::disk('public')->exists($heroSection->cta_image_path)) {
                Storage::disk('public')->delete($heroSection->cta_image_path);
            }
            $data['cta_image_path'] = $request->file('cta_image_path')->store('hero-images', 'public');
        }

        $heroSection->update($data);
        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section berhasil diperbarui.');
    }

    public function destroy(HeroSection $heroSection)
    {
        if ($heroSection->hero_image_path && Storage::disk('public')->exists($heroSection->hero_image_path)) {
            Storage::disk('public')->delete($heroSection->hero_image_path);
        }
        if ($heroSection->mid_section_image_path && Storage::disk('public')->exists($heroSection->mid_section_image_path)) {
            Storage::disk('public')->delete($heroSection->mid_section_image_path);
        }
        if ($heroSection->cta_image_path && Storage::disk('public')->exists($heroSection->cta_image_path)) {
            Storage::disk('public')->delete($heroSection->cta_image_path);
        }
        $heroSection->delete();
        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section berhasil dihapus.');
    }
}
