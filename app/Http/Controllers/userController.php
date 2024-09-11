<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        // fungsi untuk mengecek apakah ada user yang belum absen/terlambat, dan di totalkan
        $penggunaBelumAbsen = User::whereDoesntHave('absen', function ($query) {
            $query->whereDate('tanggal', Carbon::today());
        })->get();

        $penggunaTerlambat = User::whereHas('absen', function ($query) {
            $query->whereDate('tanggal', Carbon::today())
                ->whereTime('created_at', '>', '08:00:00');
        })->get();

        // pengiriman data ke view
        $data['terlambat'] = $penggunaBelumAbsen->merge($penggunaTerlambat);
        $data['terlambattotal'] = $data['terlambat']->count();
        $data['karyawans'] = User::whereNotIn('role', ['user'])
            ->with(['absen' => function ($query) {
                $query->whereDate('tanggal', date('Y-m-d'));
            }])
            ->get();
        $data['users'] = User::where('role', 'user')->get();
        return view('admin.user.index')->with($data);
    }

    public function update(Request $request, $id)
    {
        user::where('id', $id)->update([
            'role' => $request->role
        ]);

        return redirect('user')->with('success', 'Data Berhasilsil Diubah');
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('user')->with('success', 'Data Berhasilsil Dihapus');
    }
}
