<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Services\ProfileService;
use Illuminate\Events\queueable;
use App\Http\Requests\EditUserPageRequest;

class ProfileController extends Controller
{
    private ProfileService $service;

    public function __construct()
    {
        $this->service = new ProfileService;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit',['user'=> $request->user()]);
    }

    public function profileEdit(EditUserPageRequest $request)
    {

        $id = $request->id;
        $user = $this->service->getProfileUserById($id);

        return view('profile.edit', ['user'=>$user]);
    }

    public function show(string $id)
    {

        $user =  $this->service->getProfileUserById($id);

       // return view('profile.');


    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return Redirect::route('users');
        //return Redirect::route('profile.edit_user',['id' => $request->user()->id])->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
