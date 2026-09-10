<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterRequest;
use App\Models\Footer;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $footers = Footer::latest()->paginate(10);
        return view('admin.footers.index', compact('footers'));
    }

    public function create()
    {
        return view('admin.footers.create');
    }

    public function store(FooterRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo_path')) {
            $data['logo_path'] = $request->file('logo_path')->store('footer-logos', 'public');
        }

        Footer::create($data);
        return redirect()->route('admin.footers.index')->with('success', 'Pengaturan Footer berhasil ditambahkan.');
    }

    public function edit(Footer $footer)
    {
        return view('admin.footers.edit', compact('footer'));
    }

    public function update(FooterRequest $request, Footer $footer)
    {
        $data = $request->validated();

        if ($request->hasFile('logo_path')) {
            if ($footer->logo_path && Storage::disk('public')->exists($footer->logo_path)) {
                Storage::disk('public')->delete($footer->logo_path);
            }
            $data['logo_path'] = $request->file('logo_path')->store('footer-logos', 'public');
        }

        $footer->update($data);
        return redirect()->route('admin.footers.index')->with('success', 'Pengaturan Footer berhasil diperbarui.');
    }

    public function destroy(Footer $footer)
    {
        if ($footer->logo_path && Storage::disk('public')->exists($footer->logo_path)) {
            Storage::disk('public')->delete($footer->logo_path);
        }
        $footer->delete();
        return redirect()->route('admin.footers.index')->with('success', 'Pengaturan Footer berhasil dihapus.');
    }
}
