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
            'all' => dap::all(),
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

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('assets/dap-dar/', $filename);

        dap::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'file' => $filename,
            'jenis' => $request->jenis,
        ]);

        return redirect('DAP-DAR')->with('success', 'Berhasil mengirimkan data');
    }
}
