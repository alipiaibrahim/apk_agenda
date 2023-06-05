<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class AgendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $agendas = Agenda::with('users')->get();
        return view('agenda', compact('user', 'agendas'));
    }

    public function tambah_agenda(Request $req)
    {
        $agenda = new Agenda;

        $agenda->users = $req->get('users');
        $agenda->tanggal = $req->get('tanggal');
        $agenda->isi_agenda = $req->get('isi_agenda');

        $agenda->save();

        $notification = array(
            'message' => 'Data agenda berhasil ditambahkan',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.agenda.submit')->with($notification);
    }
    //Ajax Processes
    public function getDataAgenda($id)
    {
        $agenda = Agenda::find($id);

        return response()->json($agenda);
    }

    public function update_agenda(Request $req)
    {
        $pengguna = User::all();
        $agenda = Agenda::find($req->get('id'));
        // $agenda = Agenda::find($req->get('id'));

        $agenda->users = $req->get('users');
        $agenda->tanggal = $req->get('tanggal');
        $agenda->isi_agenda = $req->get('isi_agenda');

        $agenda->save();

        $notification = array(
            'message' => 'Data Brand berhasil diedit',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.agenda.update', compact('agenda', 'pengguna'))->with($notification);
    }
    public function delete_agenda(Request $req)
    {
        $agenda = Agenda::find($req->get('id'));

        $agenda->delete();
        $notification = array(
            'message' => 'Data Brand Berhasil di Hapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.agenda.delete')->with($notification);
    }
}
