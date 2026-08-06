<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\ProviderService;
use App\Models\Service;
use Illuminate\Http\Request;

class BrowseProviderController extends Controller
{
    /** Seeker — saare providers browse karo */
    public function index(Request $request)
    {
        $categories = Service::latest()->get();

        $query = ProviderService::with(['provider', 'provider.providerProfile', 'service'])
            ->latest();

        // Category filter
        if ($request->filled('category')) {
            $query->where('service_id', $request->category);
        }

        // Search filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $providers = $query->get();

        return view('pages.seeker.providers.index', compact('providers', 'categories'));
    }
}
