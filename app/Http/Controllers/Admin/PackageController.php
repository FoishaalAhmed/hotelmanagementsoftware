<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    private $packageObject;

    public function __construct()
    {
        $this->packageObject = new Package();
    }

    public function index()
    {
        $packages = Package::all();
        return view('backend.admin.package', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate(Package::$validateRule);
        $this->packageObject->storePackage($request);
        return back();
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $packages = Package::all();
        return view('backend.admin.package', compact('package', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Package::$validateRule);
        $this->packageObject->updatePackage($request, $id);
        return redirect()->route('admin.packages.index');
    }

    public function destroy($id)
    {
        $this->packageObject->destroyPackage($id);
        return back();
    }
}
