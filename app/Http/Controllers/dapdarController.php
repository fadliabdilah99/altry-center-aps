<?php

namespace App\Http\Controllers;

use App\Models\dap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dapdarController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $userId = Auth::user()->id;

        $data = [
            'daps' => dap::where('jenis', 'DAP')->where('tanggal', $today)->with('user')->get(),
            'dars' => dap::where('jenis', 'DAR')->where('tanggal', $today)->with('user')->get(),
            'all' => dap::where('tanggal', $today)->with('user')->get(),
            'no' => 'kamu sudah mengrim keduanya',
            'alldaptepat' => dap::where('tanggal', $today)->where('status', 'tepat')->where('jenis', 'DAP')->get(),
            'alldartepat' => dap::where('tanggal', $today)->where('status', 'tepat')->where('jenis', 'DAR')->get(),
            'alldapterlambat' => dap::where('tanggal', $today)->where('status', 'terlambat')->where('jenis', 'DAP')->get(),
            'alldarterlambat' => dap::where('tanggal', $today)->where('status', 'terlambat')->where('jenis', 'DAR')->get(),
        ];


        $dap = dap::where('tanggal', $today)->where('jenis', 'DAP')->where('user_id', $userId)->first();
        $dar = dap::where('tanggal', $today)->where('jenis', 'DAR')->where('user_id', $userId)->first();

        if (is_null($dap)) {
            $data['no'] = 'add_Dap';
        } elseif (!is_null($dap) && is_null($dar)) {
            $data['no'] = 'add_Dar';
        }

        $data['daptepat'] = $data['alldaptepat']->count() + $data['alldartepat']->count();
        $data['dapterlambat'] = $data['alldapterlambat']->count() + $data['alldarterlambat']->count();

        return view('admin.dap-dar.index')->with($data);
    }


    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'file' => 'required',
            'jenis' => 'required',
        ]);
        // dd(date('h:i:s'));
        if ($request->jenis == 'DAP') {
            if (date('h:i:s') >= strtotime('09:00:00')) {
                dd('tepat');
                $status = 'tepat';
            } else {
                dd('terlambat');
                $status = 'terlambat';
            }
        } else {
            dd('masuk');
            if (date('h:i:s') <= strtotime('17:00:00')) {
                return redirect()->back()->with('error', 'DAR hanya bisa dikirim pada pukul 17:00');
            } elseif (date('h:i:s') >= strtotime('17:00:00')) {
                $status = 'tepat';
            } elseif (date('h:i:s') <= strtotime('21:00:00')) {
                $status = 'terlambat';
            }
        }
dd($status);

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('assets/dap-dar/', $filename);

        dap::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'status' => $status,
            'file' => $filename,
            'jenis' => $request->jenis,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengirimkan data');
    }
}
