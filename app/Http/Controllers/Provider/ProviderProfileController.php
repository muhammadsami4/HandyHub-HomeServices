<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProviderProfileController extends Controller
{
    /**
     * SHOW PROFILE
     */
    public function index()
    {
        $profile = ProviderProfile::where('user_id', Auth::id())->first();

        return view('pages.provider.profile.index', compact('profile'));
    }

    /**
     * STORE / UPDATE PROFILE
     */
    public function store(Request $request)
    {
        $request->validate([

            'organization_name'      => 'required',
            'organization_type'      => 'required',
            'phone'                  => 'required',

            'registration_certificate' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'tax_certificate'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'organization_logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'owner_cnic_front'         => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'owner_cnic_back'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'police_clearance'         => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096', //  NEW
        ]);

        $profile = ProviderProfile::firstOrNew([
            'user_id' => Auth::id()
        ]);

        // TEXT FIELDS
        $profile->organization_name    = $request->organization_name;
        $profile->organization_type    = $request->organization_type;
        $profile->phone                = $request->phone;
        $profile->website              = $request->website;
        $profile->province             = $request->province;
        $profile->city                 = $request->city;
        $profile->address              = $request->address;
        $profile->description          = $request->description;
        $profile->registration_number  = $request->registration_number;

        /**
         * SAFE UPLOAD FUNCTION (DELETE OLD FIRST)
         */
        $uploadPath = public_path('assets/documents/');

        $uploadFile = function ($file, $oldFile = null) use ($uploadPath) {

            if (!$file) {
                return $oldFile;
            }

            // DELETE OLD FILE IF EXISTS
            if ($oldFile) {
                $oldPath = $uploadPath . $oldFile;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // NEW FILE NAME
            $fileName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            return $fileName;
        };

        /**
         * FILE FIELDS
         */
        $profile->registration_certificate = $uploadFile(
            $request->file('registration_certificate'),
            $profile->registration_certificate
        );

        $profile->tax_certificate = $uploadFile(
            $request->file('tax_certificate'),
            $profile->tax_certificate
        );

        $profile->organization_logo = $uploadFile(
            $request->file('organization_logo'),
            $profile->organization_logo
        );

        $profile->owner_cnic_front = $uploadFile(
            $request->file('owner_cnic_front'),
            $profile->owner_cnic_front
        );

        $profile->owner_cnic_back = $uploadFile(
            $request->file('owner_cnic_back'),
            $profile->owner_cnic_back
        );

        //  POLICE CLEARANCE — NEW
        $profile->police_clearance = $uploadFile(
            $request->file('police_clearance'),
            $profile->police_clearance
        );

        // PROFILE STATUS
        $profile->profile_completed = true;
        $profile->user_id           = Auth::id();
        $profile->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}