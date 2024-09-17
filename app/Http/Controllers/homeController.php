<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function homeadmin(Request $request)
    {
        // fungsi untuk mengecek apakah ada user yang belum absen/terlambat, dan di totalkan
        $data['penggunaBelumAbsen'] = User::whereDoesntHave('absen', function ($query) {
            $query->whereDate('tanggal', Carbon::today());
        })->get();

        $data['penggunaTerlambat'] = User::whereHas('absen', function ($query) {
            $query->whereDate('tanggal', Carbon::today())
                ->whereTime('created_at', '>', '08:00:00');
        })->get();


        $karyawan = User::whereNotIn('role', ['user'])
            ->with(['absen' => function ($query) {
                $query->whereDate('tanggal', date('Y-m-d'));
            }])
            ->get();

        if ($request->sortir == null) {
            $data['karyawans'] = $karyawan;
            $data['keterangan'] = 'semua karyawan';
        }else{
            $data['karyawans'] = 'ada request';
        }



        // penjumlahan count
        $data['terlambat'] = $data['penggunaTerlambat']->count();
        $data['belumabsen'] = $data['penggunaBelumAbsen']->count();
        $data['karyawantotal'] = $karyawan->count();
        $data['tepatwaktu'] =  $data['karyawantotal'] - $data['terlambat'] - $data['belumabsen'];
        return view('admin.home')->with($data);
    }
}
