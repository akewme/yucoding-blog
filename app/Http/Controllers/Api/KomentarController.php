<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\komentar;
use Auth;
use DB;

class KomentarController extends Controller
{
    
    // Get All Komentar artikel Id
    public function getKomentars($id){
        // return $id;
        return komentar::where("artikel_id",$id)
                ->join('users', 'users.id', '=', 'komentars.user_id')
                ->select('komentars.*', 'users.name')
                ->get();
    }
    // Get All Komentar Reply Id
    public function getReply($komentarId){
        
    }
    // Tambah
    public function tambahKomentar(Request $req){

        $this->validate($req, [
            'komentar' => 'required',
            'artikel_id' => 'required',
        ]);

        $komentar = new komentar;
        $komentar->komentar = $req['komentar'];

        if($req['induk']){
            $komentar->induk = $req['induk'];
        }

        $komentar->artikel_id = $req['artikel_id'];
        $komentar->user_id = Auth::user()->id;
        $komentar->save();

        return array($komentar, Auth::user());

    }
    // Edit
    public function editKomentar(Request $req, $id){
        $this->validate($req, [
            'komentar' => 'required',
            'artikel_id' => 'required',
        ]);

        $komentar = komentar::find($id);
        $komentar->komentar = $req['komentar'];

        if($req['induk']){
            $komentar->induk = $req['induk'];
        }

        $komentar->artikel_id = $req['artikel_id'];
        $komentar->user_id = Auth::user()->id;
        $komentar->update();

        return $komentar;
    }
    // Hapus
    public function hapusKomentar($id){

        $komentar = komentar::find($id);
        $komentar->delete();
        return $komentar;
        
    }
}
