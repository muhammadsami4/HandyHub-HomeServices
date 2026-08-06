<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // SHOW PAGE
    public function index()
    {
        $services = Service::latest()->get();

        return view('pages.admin.services.create', compact('services'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'icon' => 'nullable',
        ]);

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return redirect()->back()->with('success', 'Service Added Successfully');
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'icon' => 'nullable',
        ]);

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return redirect()->back()->with('success', 'Service Updated Successfully');
    }

    // DELETE
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return redirect()->back()->with('success', 'Service Deleted Successfully');
    }
}
