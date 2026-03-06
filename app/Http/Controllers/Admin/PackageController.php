<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function index()
    {
        $packages = Package::latest()->get();

        return view('admin.packages.index', compact('packages'));
    }


    public function create()
    {
        return view('admin.packages.create');
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package created');

    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted');
    }

}