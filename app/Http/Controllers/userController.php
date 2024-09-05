<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $data['users'] = User::get();
        // dd($data);
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
