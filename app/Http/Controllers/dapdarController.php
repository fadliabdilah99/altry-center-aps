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
        if(Auth::user()->role != 'admin'){
            $data['daps'] = dap::where('jenis', 'DAP')->with('user')->get();
            $data['dars'] = dap::where('jenis', 'DAR')->with('user')->get();
        }else{
            $data['daps'] = dap::where('user_id', Auth::user()->id)->where('jenis', 'DAP')->get();
            $data['dars'] = dap::where('user_id', Auth::user()->id)->where('jenis', 'DAR')->get();
        }

        $dap = dap::where('tanggal', Carbon::now()->format('Y-m-d'))->where('jenis', 'DAP')->where('user_id', Auth::user()->id)->first();
        $dar = dap::where('tanggal', Carbon::now()->format('Y-m-d'))->where('jenis', 'DAR')->where('user_id', Auth::user()->id)->first();
        if($dap == null){
            $data['no'] = 'add_Dar';
        }else if(!empty($dap) && empty($dar)){ 
            $data['no'] = 'add_Dap';
        }else{
            $data['no'] = 'kamu sudah mengrim keduanya';
        }

        return view('admin.dap-dar.index')->with($data);
    }
}
