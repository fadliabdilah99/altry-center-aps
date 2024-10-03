<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;

class userController extends Controller
{
    public function index()
    {

        $data['karyawans'] = User::whereNotIn('role', ['user'])->get();



        $data['users'] = User::where('role', 'user')->get();
        // dd($data['karyawans']);

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
