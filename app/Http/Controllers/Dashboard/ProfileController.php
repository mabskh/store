<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function editProfile()
    {
        // get Authenticated Admin That Logged in From Admin Model.
        $admin = Admin::find(auth('admin')->user()->id);

        // Passing Admin Data to view file
        return view('dashboard.profile.edit', compact('admin'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        try {
            $admin = Admin::find(auth('admin')->user()->id); // get current Admin ID

            if ($request->filled('password')){
                 $request->merge(['password' => bcrypt($request->password)]);
            } // if Request Of Password Has Real Value, Add Password encrypted

            unset($request['id']); // Delete ID for More Security
            unset($request['password_confirmation']); // Delete confirmation Key Request

            $admin->update($request->all()); // Update All Data In DB

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
        }
    }
}
