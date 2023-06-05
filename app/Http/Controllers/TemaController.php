<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Tema;

class TemaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $temas = Tema::all();
        return view('tema', compact('user', 'temas'));
    }

    public function tambah_tema(Request $req)
    {
        $tema = new Tema;

        $tema->topik = $req->get('topik');
        $tema->tanggal = $req->get('tanggal');
        $tema->tema = $req->get('tema');
        $tema->isi_kegiatan = $req->get('isi_kegiatan');

        $tema->save();

        $notification = array(
            'message' => 'Data tema berhasil ditambahkan',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.tema.submit')->with($notification);
    }
    //Ajax Processes
    public function getDataTema($id)
    {
        $tema = tema::find($id);

        return response()->json($tema);
    }

    public function update_tema(Request $req)
    {
        $tema = Tema::find($req->get('id'));

        $tema->topik = $req->get('topik');
        $tema->tanggal = $req->get('tanggal');
        $tema->tema = $req->get('tema');
        $tema->isi_kegiatan = $req->get('isi_kegiatan');

        $tema->save();

        $notification = array(
            'message' => 'Data Brand berhasil diedit',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.tema.update')->with($notification);
    }
    public function delete_tema(Request $req)
    {
        $tema = Tema::find($req->get('id'));

        $tema->delete();
        $notification = array(
            'message' => 'Data Brand Berhasil di Hapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.tema.delete')->with($notification);
    }
}
