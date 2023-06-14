<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Session;

class TopikController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $topiks = Topik::all();
        return view('topik', compact('user', 'topiks'));
    }
    public function submit_topik(Request $req)
    {
        $topik = new Topik;

        $topik->nama = $req->get('nama');

        $topik->save();

        $notification = array(
            'message' => 'Data Topik berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.topik')->with($notification);
    }
    public function update_topik(Request $req)
    {
        $topik = Topik::find($req->get('id'));

        $topik->nama = $req->get('nama');

        $topik->save();

        $notification = array(
            'message' => 'Data Topik berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.topik')->with($notification);
    }

    public function getDataTopik($id)
    {
        $topik = Topik::find($id);

        return response()->json($topik);
    }

    public function delete_topik(Request $req, $id)
    {
        $topik = Topik::find($id);
        // storage::delete('public/photo_user/' . $req->get('old_photo'));
        $topik->delete();

        Session::flash('status', 'Hapus data topik berhasil!!!');
        return redirect()->back();
    }
}
