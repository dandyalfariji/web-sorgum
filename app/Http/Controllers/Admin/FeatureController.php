<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureRequest;
use App\Models\Feature;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(FeatureRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');
        Feature::create($data);
        return redirect()->route('admin.features.index')->with('success', 'Fitur keunggulan berhasil ditambahkan.');
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(FeatureRequest $request, Feature $feature)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');
        $feature->update($data);
        return redirect()->route('admin.features.index')->with('success', 'Fitur keunggulan berhasil diperbarui.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.features.index')->with('success', 'Fitur keunggulan berhasil dihapus.');
    }
}
