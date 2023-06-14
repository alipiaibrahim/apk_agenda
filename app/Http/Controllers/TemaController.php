<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Tema;
use App\Models\Topik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Session;

class TemaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $agenda =  Agenda::all();
        $topik =  Topik::all();
        $temas = Tema::with('agenda', 'topik')->get();
        return view('tema', compact('user', 'temas', 'agenda', 'topik'));
    }

    public function tambah_tema(Request $req)
    {
        $tema = new Tema;

        $tema->topiks = $req->get('topiks');
        $tema->tanggal = $req->get('tanggal');
        $tema->tema = $req->get('tema');
        $tema->agendas = $req->get('agendas');

        $tema->save();

        $notification = array(
            'message' => 'Data Tema berhasil ditambahkan',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.tema')->with($notification);
    }
    //Ajax Processes
    public function getDataTema($id)
    {
        $tema = Tema::find($id);

        return response()->json($tema);
    }

    public function update_tema(Request $req)
    {
        $tema = Tema::find($req->get('id'));
        // $tema = tema::find($req->get('id'));

        $tema->topiks = $req->get('topiks');
        $tema->tanggal = $req->get('tanggal');
        $tema->tema = $req->get('tema');
        $tema->agendas = $req->get('agendas');

        $tema->save();

        $notification = array(
            'message' => 'Data Brand berhasil diedit',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.tema')->with($notification);
    }
    public function delete_tema(Request $req, $id)
    {
        $tema = Tema::where('id', $id);
        $tema->delete();
        Session::flash('status', 'Hapus data tema berhasil!!!');
        return redirect()->back();
    }
}
