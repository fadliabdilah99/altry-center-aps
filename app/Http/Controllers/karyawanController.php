<?php

namespace App\Http\Controllers;

use App\Models\dap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class karyawanController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $userId = Auth::user()->id;

        $dap = dap::where('tanggal', $today)->where('jenis', 'DAP')->where('user_id', $userId)->first();
        $dar = dap::where('tanggal', $today)->where('jenis', 'DAR')->where('user_id', $userId)->first();

        if (is_null($dap)) {
            $data['no'] = 'add_Dap';
        } elseif (!is_null($dap) && is_null($dar)) {
            $data['no'] = 'add_Dar';
        }
        return view('karyawan.index')->with($data);
    }
}
