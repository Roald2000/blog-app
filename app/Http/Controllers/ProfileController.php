<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        if (Auth::check()) {

            $auth_id = auth()->user()->id;
            $user = User::find($auth_id);

            if (!$user) {
                return redirect(route('auth.logout-user'));
            }

            $profile = $user->profile;

            if (!$profile) {
                return redirect(route('profile.setup-profile'));
            }

            return view('profile.profile', compact('profile'));
        } else {
            return redirect(route('auth.logout-user'));
        }
    }

    public function checkProfile($id)
    {

        if (Auth::check()) {
            $auth_id = auth()->user()->id;
            $user = User::find($id);

            if (!$user) {
                return view('profile.user-not-found');
            }

            $profile = $user->profile;

            if (!$profile) {
                return view('profile.no-profile', ['id' => $id]);
            }

            return view('profile.check-profile', compact('profile'));
        } else {
            return redirect(route('auth.logout-user'));
        }
    }


    public function setupProfile()
    {
        if (Auth::check()) {


            $auth_id = auth()->user()->id;
            $user = User::find($auth_id);

            if (!$user) {
                return redirect(route('auth.logout-user'));
            }

            $profile = $user->profile;

            return view('profile.setup-profile', compact('profile'));
        } else {
            return redirect(route('auth.logout-user'));
        }
    }

    public function createOrUpdateProfile(Request $request)
    {

        if (Auth::check()) {
            function santize(string|int $value)
            {
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                $value = strip_tags($value);
                return $value;
            };

            $request->validate([
                'name' => ['required'],
                'contact' => ['required'],
                'address' => 'required',
                'age' => ['required', 'integer'],
                'gender' => 'required',
                'account_status' => 'required'
            ]);

            $profiledata = [
                'contact' => santize($request->contact),
                'address' => santize($request->address),
                'age' => santize($request->age),
                'gender' => santize($request->gender),
                'account_status' => santize($request->account_status),
                'user_id' => auth()->user()->id
            ];

            UserProfile::updateOrCreate(['user_id' => auth()->user()->id], $profiledata);

            // auth()->user()->update(['name' => santize($request->name)]);
            auth()->user()->update(['name' => santize($request->name)]);

            return redirect(route('profile.profile'));
        } else {
            return redirect(route('auth.logout-user'));
        }
    }
}
