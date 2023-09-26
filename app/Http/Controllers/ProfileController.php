<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Items;
use App\Models\Ticket;
use App\Models\Target_limit;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::back()
        ->with('success', 'user update successfuly');  
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')
        ->with('success', 'user destroy successfuly');
    }

    //reset data
    public function Reset_Data(Request $request): RedirectResponse
    {
        $request->validate([
            'password_test' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $Tickets_and_Items = $request->get('Tickets_and_Items');
        $theme = $request->get('theme');
        $action_color = $request->get('theme');
        $avatar = $request->get('avatar');
        $currency = $request->get('currency');
        $target_plan = $request->get('target_plan');

        if(isset($Tickets_and_Items)){
            Ticket::where('user_id', $user->id)->delete();
            Items::where('user_id', $user->id)->delete();
        }
        if(isset($theme)){
            $user->sid_img = 'icon/sid_bar/wallpapers/img_1.jpg';
            $user->save();
        }
        if(isset($action_color)){
            $user->filter = '#ffc502';
            $user->save();
        }
        if(isset($avatar)){
            $user->avatar = 'icon/sid_bar/avatar/avatar1.png';
            $user->save();
        }
        if(isset($currency)){
            $user->main_currency = 'TND';
            $user->save();
        }
        if(isset($target_plan)){
            Target_limit::where('user_id', $user->id)->delete();
        }

        return Redirect::back()
        ->with('success', 'data reset successfuly');
    }

    //theme
    public function updateTheme(User $user , $theme_id)
    {
        $user->filter = "#".$theme_id;
        $user->save();
        return Redirect::back()
        ->with('success', 'filter update successfuly');  

    }

    //sid_img
    public function updateSideImg(User $user , $sid_img_id): RedirectResponse
    {
        $user->sid_img = 'icon/sid_bar/wallpapers/'.$sid_img_id;
        $user->save();
        return Redirect::back()
        ->with('success', 'side image update successfuly');  
    }

    //avatar
    public function updateAvatar(User $user , $avatar): RedirectResponse
    {
        $user->avatar = 'icon/sid_bar/avatar/'.$avatar;
        $user->save();
        return Redirect::back()
        ->with('success', 'avatar update successfuly');  
    }
}
