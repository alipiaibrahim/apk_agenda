<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Session;
use PDF;

class AgendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pengguna =  User::all();
        $agendas = Agenda::with('pengguna')->get();
        return view('agenda', compact('user', 'agendas', 'pengguna'));
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


        return redirect()->route('admin.agenda')->with($notification);
    }
    //Ajax Processes
    public function getDataAgenda($id)
    {
        $agenda = Agenda::find($id);

        return response()->json($agenda);
    }

    public function update_agenda(Request $req)
    {
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


        return redirect()->route('admin.agenda')->with($notification);
    }
    public function delete_agenda(Request $req, $id)
    {
        $agenda = Agenda::where('id', $id);
        $agenda->delete();
        Session::flash('status', 'Hapus data Agenda berhasil!!!');
        return redirect()->back();
    }
    public function print_agenda()
    {
        $agenda = Agenda::all();
        $pdf = PDF::loadview('print_agenda', ['agenda' => $agenda]);
        return $pdf->download('data_agenda.pdf');
    }
}
