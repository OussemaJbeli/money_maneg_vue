<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $User = new User();

        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->avatar = 'icon/sid_bar/avatar/avatar1.png';
        $User->sid_img = 'icon/sid_bar/wallpapers/img_1.jpg';
        $User->filter = '#ffc502';

        $User->save();

        event(new Registered($User));

        Auth::login($User);

        return redirect(RouteServiceProvider::HOME);
    }
}
