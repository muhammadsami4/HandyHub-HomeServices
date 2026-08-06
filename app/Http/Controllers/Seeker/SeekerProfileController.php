<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\SeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SeekerProfileController extends Controller
{
    /**
     * SHOW PROFILE
     */
    public function index()
    {
        $profile = SeekerProfile::where('user_id', Auth::id())->first();

        return view('pages.seeker.profile.index', compact('profile'));
    }



    /**
     * STORE / UPDATE PROFILE
     */
    public function store(Request $request)
    {
        $request->validate([

            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'bio' => 'nullable|string',

            'province' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'home_address' => 'nullable|string|max:255',

            'cnic_front' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'cnic_back' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'income_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'profile_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);



        // FIND OR CREATE PROFILE
        $profile = SeekerProfile::firstOrNew([
            'user_id' => Auth::id()
        ]);



        /**
         * BASIC INFO
         */
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->bio = $request->bio;



        /**
         * ADDRESS INFO
         */
        $profile->province = $request->province;
        $profile->city = $request->city;
        $profile->home_address = $request->home_address;



        /**
         * UPLOAD PATH
         */
        $uploadPath = public_path('assets/documents/');



        /**
         * SAFE UPLOAD + DELETE OLD FILE
         */
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
         * FILES (WITH REPLACE LOGIC)
         */

        $profile->cnic_front = $uploadFile(
            $request->file('cnic_front'),
            $profile->cnic_front
        );

        $profile->cnic_back = $uploadFile(
            $request->file('cnic_back'),
            $profile->cnic_back
        );

        $profile->income_proof = $uploadFile(
            $request->file('income_proof'),
            $profile->income_proof
        );

        $profile->profile_image = $uploadFile(
            $request->file('profile_image'),
            $profile->profile_image
        );



        /**
         * USER LINK
         */
        $profile->user_id = Auth::id();



        /**
         * PROFILE COMPLETION CHECK
         */
        $profile->profile_completed = $this->isComplete($profile);



        $profile->save();



        return back()->with('success', 'Profile updated successfully!');
    }



    /**
     * PROFILE COMPLETION CHECK
     */
    private function isComplete($profile)
    {
        return !empty($profile->phone)
            && !empty($profile->gender)
            && !empty($profile->province)
            && !empty($profile->city)
            && !empty($profile->home_address)
            && !empty($profile->cnic_front)
            && !empty($profile->cnic_back);
    }
}