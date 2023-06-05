<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jadwals = Jadwal::all();
        return view('jadwal', compact('user', 'jadwals'));
    }
    public function tambah_drug(Request $req)
    {
        $jadwal = new Jadwal;

        $jadwal->gurus = $req->get('gurus');
        $jadwal->hari = $req->get('hari');
        $jadwal->mapel = $req->get('mapel');
        $jadwal->jam_mulai = $req->get('jam_mulai');
        $jadwal->jam_selesai = $req->get('jam_selesai');
        $jadwal->kelas = $req->get('kelas');


        $jadwal->save();

        $notification = array(
            'message' => 'Data Jadwal berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.jadwals')->with($notification);
    }
}
