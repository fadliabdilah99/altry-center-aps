<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\absen;
use App\Models\skor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data['user'] = User::where('id', $id)->first();
        $now = Carbon::now()->format('Y-m-d');


        // memanggil semua data absen 
        $data['timeline'] = absen::where('user_id', $data['user']->id)->orderBy('tanggal', 'asc')->get()->groupBy('tanggal');

        // menhitung presentase ketepatan waktu secara keseluruhan
        $tepat = absen::whereTime('created_at', '<=', '08:00:00')->where('user_id', $data['user']->id)->distinct('tanggal')->count();
        $data['lamaBekerja'] = (int) $data['user']->created_at->diffInWeekdays($now);
        $data['presentase'] = intval(($tepat / $data['lamaBekerja']) * 100);
        $data['bolos'] = $data['lamaBekerja'] - $tepat;

        // mengirim data warna sesuai presentase
        if ($data['presentase'] < 100 && $data['presentase'] > 75) {
            $data['Cpresentase'] = 'text-success';
        } elseif ($data['presentase'] < 75 && $data['presentase'] > 50) {
            $data['Cpresentase'] = 'text-warning';
        } else {
            $data['Cpresentase'] = 'text-danger';
        }


        // gajih dan potongan dan presentase absen bulanan
        $data['bulanan'] = Carbon::now()->format('d') - absen::where('user_id', $data['user']->id)->whereMonth('created_at', Carbon::now()->month)->whereTime('created_at', '<=', '08:00:00')->distinct('tanggal')->count();
        $data['gajibulanan'] = $data['user']->gajih;
        $data['potonganbulanan'] = $data['user']->gajih * $data['bulanan'] / 100;

        // keterangan pelanggaran dan potongan
        $telat = $data['bulanan'];
        $data['pelanggaran'] = skor::where('user_id', $data['user']->id)->whereMonth('created_at', Carbon::now()->month)->get();

        $data['countpelanggaran'] = $data['pelanggaran']->count() + $telat;
 



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
