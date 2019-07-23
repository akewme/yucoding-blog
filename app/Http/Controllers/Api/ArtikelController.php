<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Auth;

use App\artikel;

class ArtikelController extends Controller
{
    // Get Artikels
    public function getArtikels(){
        return artikel::orderBy("created_at","DESC")
                        ->paginate(15);
    }
    // Get Single Artikel
    public function getArtikel($slug){
        return artikel::where("slug",$slug)->first();
    }
    public function tambahArtikel(Request $req){

        if(!Auth::user()){
            return redirect("login");
        }
        $this->validate($req, [
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
            'image' => 'required',

        ]);
        $imagename = time().'.'.request()->image->getClientOriginalExtension();

        $req->file('image')->move(public_path('img'), $imagename);

        $slug = Str::slug($req['judul'], '-');
        $new = new artikel;
        $new->judul = $req['judul']; 
        $new->isi = $req['isi']; 
        $new->kategori = $req['kategori']; 
        $new->video = $req['video']; 
        $new->img = $imagename; 
        $new->slug = $slug; 
        $new->user_id = Auth::user()->id; 
        $new->save();
        
        return $new;
    }

    public function editArtikel(Request $req){
        if(!Auth::user()){
            return redirect("login");
        }
        $this->validate($req, [
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
        ]);


        $slug = Str::slug($req['judul'], '-');
        $edit = artikel::find($req['id']);

        if($req->file('image')){
            $this->validate($req, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    
            ]);
            $imagename = time().'.'.request()->image->getClientOriginalExtension();
            $req->file('image')->move(public_path('img'), $imagename);
            $edit->img = $imagename; 
        }
        $edit->judul = $req['judul']; 
        $edit->isi = $req['isi']; 
        $edit->kategori = $req['kategori']; 
        $edit->video = $req['video']; 
        $edit->slug = $slug; 
        $edit->user_id = Auth::user()->id; 
        $edit->update();

        return $edit;
    }

    public function hapusArtikel($id){

        if(!Auth::user()){
            return redirect("login");
        }
        $delete = artikel::find($id);
        $delete->delete();

        return $delete;
    }
}
