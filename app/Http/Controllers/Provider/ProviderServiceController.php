<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\ProviderService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderServiceController extends Controller
{
    /** Provider ki apni services list */
    public function index()
    {
        $myServices = ProviderService::where('provider_id', Auth::id())
            ->with('service')
            ->latest()
            ->get();

        $categories = Service::latest()->get(); // Categories for dropdown

        return view('pages.provider.services.index', compact('myServices', 'categories'));
    }

    /** Nayi service add karo */
    public function store(Request $request)
    {
        $request->validate([
            'service_id'  => 'required|exists:services,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'experience'  => 'nullable|string|max:100',
        ]);

        // Ek provider ek category mein sirf ek service add kar sakta hai
        $exists = ProviderService::where('provider_id', Auth::id())
            ->where('service_id', $request->service_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Aap ne is category mein pehle se service add ki hui hai!');
        }

        ProviderService::create([
            'provider_id' => Auth::id(),
            'service_id'  => $request->service_id,
            'title'       => $request->title,
            'description' => $request->description,
            'experience'  => $request->experience,
        ]);

        return back()->with('success', 'Service successfully add ho gayi!');
    }

    /** Service delete karo */
    public function destroy($id)
    {
        $service = ProviderService::where('id', $id)
            ->where('provider_id', Auth::id())
            ->firstOrFail();

        $service->delete();

        return back()->with('success', 'Service delete ho gayi!');
    }
}
