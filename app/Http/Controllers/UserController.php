<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        return view('user', compact('user', 'users'));
    }
    public function submit_user(Request $req)
    {
        $pengguna = new User;

        $pengguna->name = $req->get('name');
        $pengguna->tanggal = $req->get('tanggal');
        $pengguna->no_tlp = $req->get('no_tlp');
        $pengguna->username = $req->get('username');
        $pengguna->email = $req->get('email');
        $pengguna->password = $req->get('password');
        $pengguna->roles_id = $req->get('roles_id');


        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_user',
                $filename
            );

            $pengguna->photo = $filename;
        }
        $pengguna->save();

        $notification = array(
            'message' => 'Data User berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pengguna.submit')->with($notification);
    }
    public function update(Request $req)
    {
        $pengguna = User::find($req->get('id'));

        $pengguna->name = $req->get('name');
        $pengguna->tanggal = $req->get('tanggal');
        $pengguna->no_tlp = $req->get('no_tlp');
        $pengguna->username = $req->get('username');
        $pengguna->email = $req->get('email');
        $pengguna->password = $req->get('password');
        $pengguna->roles_id = $req->get('roles_id');


        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_user',
                $filename
            );
            Storage::delete('public/photo_user/' . $req->get('old_photo'));

            $pengguna->photo = $filename;
        }
        $pengguna->save();

        $notification = array(
            'message' => 'Data User berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pengguna.update')->with($notification);
    }

    public function getDataUser($id)
    {
        $pengguna = User::find($id);

        return response()->json($pengguna);
    }

    public function delete_user(Request $req)
    {
        $pengguna = User::find($req->get('id'));

        storage::delete('public/photo_user/' . $req->get('old_photo'));

        $pengguna->delete();

        $notification = array(
            'message' => 'Data User Berhasil Dihapus',
            'alert-type' => 'succes'
        );

        return redirect()->route('admin.pengguna.delete')->with($notification);
    }
}
