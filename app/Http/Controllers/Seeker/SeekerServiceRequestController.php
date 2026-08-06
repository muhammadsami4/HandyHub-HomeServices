<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeekerServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with('service')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pages.seeker.services.index', compact('requests'));
    }

    public function create()
    {
        $services = Service::latest()->get();
        return view('pages.seeker.services.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id'   => 'required',
            'description'  => 'nullable',
            'price_range'  => 'nullable',
            'location'     => 'nullable',
            'latitude'     => 'nullable',
            'longitude'    => 'nullable',
            'work_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 
        ]);

        //  Work picture upload
        $workPicture = null;

        if ($request->hasFile('work_picture')) {
            $file        = $request->file('work_picture');
            $fileName    = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/documents'), $fileName);
            $workPicture = $fileName;
        }

        ServiceRequest::create([
            'user_id'      => auth()->id(),
            'service_id'   => $request->service_id,
            'description'  => $request->description,
            'price_range'  => $request->price_range,
            'location'     => $request->location,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'work_picture' => $workPicture, // ✅
        ]);

        return redirect()->back()->with('success', 'Service Request Sent Successfully');
    }
}