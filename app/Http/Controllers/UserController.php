<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\VolunteerCoverage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function fetchRegisterPage()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function doRegistration(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'min:6', 'max:30', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'max:18', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($request->role == "VOLUNTEER") { $user->coverageArea()->save(new VolunteerCoverage());}

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function fetchLoginPage()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogin(LoginRequest $request)
    {
        $request->ensureIsNotRateLimited();

        if (! Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            RateLimiter::hit($request->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($request->throttleKey());

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    public function username()
    {
        return 'username';
    }

    public function fetchProfilePage ($id) {
        $user = User::findOrFail($id);
        $option = 'view';
        return view('user-profile', compact('user', 'option'));
    }

    public function fetchEditProfileForm ($id) {
        $user = User::findOrFail($id);
        $option = 'update';
        return view('user-profile', compact('user', 'option'));
    }

    public function update(Request $request, $id) {

        $user = User::findOrFail($id);

        $request->validate([
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'max:12', 'string'],
        ]);

        if($user->email != $request->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);

            User::where('id',$id)->update(['email'=>$request->email]);
        }

        if($user->username != $request->username) {
            $request->validate([
                'username' => ['required', 'string', 'max:30', 'unique:users'],
            ]);

            User::where('id',$id)->update(['username'=>$request->username]);
        }

        if($request->file('image')){
            if ($user->image != null) {
                unlink(public_path($user->image));
            }

            $request->validate([
                'image' => ['required', 'image'],
            ]);

            $path = "storage/image/profile-picture";
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            //$file-> move(public_path('storage/image/profile-picture'), $filename);

            $file->storeAs(
                $path,
                $filename,
                's3'
            );
            
            User::where('id',$id)->update([
                'image' => $path."/".$filename
            ]);
        }

        if($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', 'max:18', Rules\Password::defaults()],
            ]);

            User::where('id',$id)->update(['password' => Hash::make($request->password)]);
        }

        User::where('id',$id)->update([
            'address'=>$request->address, 
            'phone_number'=>$request->phone_number,
        ]);
        return redirect()->back();
    }
}
