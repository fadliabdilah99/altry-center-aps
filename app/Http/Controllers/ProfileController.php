<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\absen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = Auth::user();

        // memanggil semua data absen 
        $data['timeline'] = absen::where('user_id', $data['user']->id)->orderBy('tanggal', 'asc')->get()->groupBy('tanggal');

        // menhitung presentase ketepatan waktu
        $tepat = absen::whereTime('created_at', '<=', '08:00:00')->where('user_id', $data['user']->id)->count(); 
        $all = absen::where('user_id', $data['user']->id)->count(); 
        $data['presentase'] = ($tepat / $all) * 100;
        if ($data['presentase'] < 100 && $data['presentase'] > 75) {
           $data['Cpresentase'] = 'text-success';
        }elseif ($data['presentase'] < 75 && $data['presentase'] > 50) {
            $data['Cpresentase'] = 'text-warning';
        }else{
            $data['Cpresentase'] = 'text-danger';
        }
        return view('karyawan.profile.index')->with($data);
    }



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
