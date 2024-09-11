<?php

namespace App\Http\Controllers;

use App\Models\absen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class absenController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'foto' => 'required',
            'kategori' => 'required',
        ]);


        $file = $request->file('foto');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('assets/absen/', $filename);

        absen::create([
            'user_id' => $request->user_id,
            'foto' => $filename,
            'kategori' => $request->kategori,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengirimkan data');
    }

    public function destroy($id)
    {
        $absen = absen::find($id);
        $path = public_path() . '/assets/absen/' . $absen->foto;
        if (file_exists($path)) {
            @unlink($path);
        }
        $absen->delete();
        return redirect()->back()->with('success', 'Berhasil mengirimkan data');
    }
}
