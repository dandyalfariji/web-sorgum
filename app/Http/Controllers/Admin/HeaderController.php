<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeaderRequest;
use App\Models\Header;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    public function index()
    {
        $headers = Header::with('menuItems')->latest()->paginate(10);
        return view('admin.headers.index', compact('headers'));
    }

    public function create()
    {
        return view('admin.headers.create');
    }

    public function store(HeaderRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo_path')) {
            $data['logo_path'] = $request->file('logo_path')->store('header-logos', 'public');
        }

        Header::create($data);
        return redirect()->route('admin.headers.index')->with('success', 'Header navigasi berhasil ditambahkan.');
    }

    public function edit(Header $header)
    {
        return view('admin.headers.edit', compact('header'));
    }

    public function update(HeaderRequest $request, Header $header)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo_path')) {
            if ($header->logo_path && Storage::disk('public')->exists($header->logo_path)) {
                Storage::disk('public')->delete($header->logo_path);
            }
            $data['logo_path'] = $request->file('logo_path')->store('header-logos', 'public');
        }

        $header->update($data);
        return redirect()->route('admin.headers.index')->with('success', 'Header navigasi berhasil diperbarui.');
    }

    public function destroy(Header $header)
    {
        if ($header->logo_path && Storage::disk('public')->exists($header->logo_path)) {
            Storage::disk('public')->delete($header->logo_path);
        }
        $header->delete();
        return redirect()->route('admin.headers.index')->with('success', 'Header navigasi berhasil dihapus.');
    }
}
