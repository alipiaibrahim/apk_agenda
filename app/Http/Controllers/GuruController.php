<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Guru;
use PDF;


class GuruController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $gurus = Guru::all();
        return view('guru', compact('user', 'gurus'));
    }

    public function tambah_guru(Request $req)
    {
        $guru = new Guru;

        $guru->nama = $req->get('nama');
        $guru->tanggal = $req->get('tanggal');
        $guru->alamat = $req->get('alamat');
        $guru->email = $req->get('email');

        $guru->save();

        $notification = array(
            'message' => 'Data guru berhasil ditambahkan',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.guru.submit')->with($notification);
    }
    //Ajax Processes
    public function getDataGuru($id)
    {
        $guru = Guru::find($id);

        return response()->json($guru);
    }

    public function update_guru(Request $req)
    {
        $guru = Guru::find($req->get('id'));

        $guru->nama = $req->get('nama');
        $guru->tanggal = $req->get('tanggal');
        $guru->alamat = $req->get('alamat');
        $guru->email = $req->get('email');

        $guru->save();

        $notification = array(
            'message' => 'Data Brand berhasil diedit',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.guru.update')->with($notification);
    }
    public function delete_guru(Request $req)
    {
        $guru = Guru::find($req->get('id'));

        $guru->delete();
        $notification = array(
            'message' => 'Data Brand Berhasil di Hapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.guru.delete')->with($notification);
    }
}
