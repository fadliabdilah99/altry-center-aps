<?php

namespace App\Http\Controllers;

use App\Models\skor;
use App\Models\User;
use Illuminate\Http\Request;

class skorController extends Controller
{
    public function sangsi(Request $request)
    {
        $request->validate([
            'gaji' => 'required',
            'skor' => 'required',
            'alasan' => 'required',
        ]);
        $user = User::where('id', $request->user_id)->first();
        $newSkor = $user->skor - $request->skor;
        $user->update([
            'gajih' => $request->gaji,
            'skor' => $newSkor,
        ]);
        skor::create([
            'user_id' => $request->user_id,
            'jenis' => $request->jenis,
            'skor' => $request->skor,
            'gaji' => $request->potongGaji,
            'alasan' => $request->alasan,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengirim data');
    }
}
