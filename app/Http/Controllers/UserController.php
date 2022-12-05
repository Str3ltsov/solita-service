<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Flash;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        if (!$user){
            Flash::success('No user found!');
            return view('home');
        }


//        dd($user);
//        exit();
        return view('user_views.user.profile', [
            'user' => $user
        ]);
    }

    public function store($prefix, Request $request)
    {
        $request->validate(User::$rules);
        $id = Auth::user()->id;

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->street = $request->street;
        $user->house_flat = $request->house_flat;
        $user->post_index = $request->post_index;
        $user->city = $request->city;
        $user->phone_number = $request->phone_number;
        $user->save();

        Flash::success(__('messages.userupdated'));

        return redirect(route('userprofile', $prefix));
    }

    public function changePassword($prefix, Request $request)
    {
        $validateData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $id = Auth::user()->id;
        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find($id);
            $user->password = Hash::make($request->new_password);
            $user->save();

            Flash::success(__('messages.changedpassword'));

//            return redirect(route('userprofile'));
        }
        else {
            Flash::error(__('messages.incorrectpassword'));

//            return redirect(route('userprofile'));
        }
        return redirect(route('userprofile', $prefix));
    }

    /**
     * Deleting account will not delete it entirely, but block it from access.
     */
    public function deleteAccount()
    {
        try {
            $user = Auth::user();

            $user->status_id = UserStatus::BLOCKED;
            $user->updated_at = now();
            $user->save();

            Auth::logout();
            return redirect('/products')->with('success', __('messages.successDeletedAccount'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception);
        }
    }
}
