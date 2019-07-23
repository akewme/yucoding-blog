<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\artikel;
use Auth;
use Illuminate\Support\Str;
use DataTables;

class ArtikelController extends Controller
{
    public function index(){
        return view("admin.artikel");
    }
    public function datatables(){
        $model = artikel::query();
        return Datatables::of($model)
            ->addColumn('action', function ($artikel) {
                $edit = "<a href='#' onclick='editartikel(".$artikel.")' class='btn btn-sm btn-primary mr-2'><i class='fa fa-edit'></i> Edit</a>";
                $delete = '<a href="#" onclick="deleteartikel('.$artikel->id.')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';
                return $edit . $delete;
            })
            ->make(true);
    }
    public function tambahArtikel(){
        return view("admin.artikel.tambah");
    }
    public function tambah(Request $req){

        if(!Auth::user()){
            return redirect("login");
        }
        $this->validate($req, [
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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

        return redirect("/artikel");
    }

    public function edit(Request $req){

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
        $edit->save();

        return redirect("/artikel");
    }

    public function delete(Request $req){

        if(!Auth::user()){
            return redirect("login");
        }
        $this->validate($req, [
            'id' => 'required',
        ]);
        $delete = artikel::find($req['id']);
        $delete->delete();

        return redirect("/artikel");
    }



    // Single Page Artikel

    public function singleArtikel($slug){
        
        $artikel =  artikel::where("slug",$slug)->first();

        return view("frontend.single-blog",compact("artikel"));
    }

}
