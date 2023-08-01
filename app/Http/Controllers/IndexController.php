<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;

class IndexController extends Controller
{
    //
    public function home(){
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $truyen = Truyen::orderBy('id', 'DESC')->where('kichhoat',0)->paginate(8);
        return view("pages.home")->with(compact('danhmuc', 'truyen'));
    }
    public function danhmuc($slug){
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc', $slug)->first();
        $tendanhmuc = $danhmuc_id->tendanhmuc;
        $truyen = Truyen::orderBy('id', 'DESC')->where('kichhoat', 0)->where('danhmuc_id',$danhmuc_id->id)->get();
        return view('pages.danhmuc')->with(compact('danhmuc','truyen','tendanhmuc'));
    }
    public function xemtruyen($slug){
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $truyen = Truyen::with('danhmuctruyen')->where('slug_truyen',$slug)->where('kichhoat',0)->first();
        $chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->get();
        $chapter_dau = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $cungdanhmuc = Truyen::with('danhmuctruyen')->where('danhmuc_id',$truyen->danhmuctruyen->id)->whereNotIn('id',[$truyen->id])->get();
        return view('pages.truyen')->with(compact('danhmuc','truyen','chapter','cungdanhmuc','chapter_dau'));
    }

    public function xemchapter($slug){
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        //breadcumb
        $truyen = Chapter::where('slug_chapter',$slug)->first();
        $truyen->update(['view',++$truyen->view]);
        //endbreadcumb
        $truyen_breadcumb = Truyen::with('danhmuctruyen')->where('id',$truyen->truyen_id)->first();
        $chapter = Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        $all_chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();
        // $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');
        $get_next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->first();
        $next_chapter = $get_next_chapter != null ? $get_next_chapter->slug_chapter : "";
        $max_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();
        $previous_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');
        $chapter_number = Chapter::with('truyen')->orderBy('id', 'desc')->where('truyen_id',$truyen->truyen_id)->get();
        return view('pages.chapter')->with(compact('danhmuc','chapter','all_chapter','next_chapter','previous_chapter','max_id',
        'min_id','truyen_breadcumb')); 
    }

    public function timkiem(Request $request){
        $data = $request->all();
        $tukhoa = $data['tukhoa'];
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $truyen = Truyen::with('danhmuctruyen')->where('tentruyen','LIKE','%'.$tukhoa.'%')->orWhere('tomtat','LIKE','%'.$tukhoa.'%')
        ->orWhere('tacgia','LIKE','%'.$tukhoa.'%')->get();
        return view('pages.timkiem')->with(compact('danhmuc','truyen','tukhoa')); 
    }

    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if($data['keywords']){
            $truyen = Truyen::where('kichhoat',0)->where('tentruyen','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block"></ul>';
            foreach($truyen as $key => $tr){
                $output .= '<li class="li_search_ajax"><a hred="#">'.$tr->tentruyen.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    // public function tap($slug){ //phần của thuận
    //     $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
    //     // $truyen = Truyen::with('danhmuctruyen')->where('slug_truyen',$slug)->where('kichhoat',0)->first();   
    //     // $chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$slug)->get();
    //     return view('pages.chapter')->with(compact('danhmuc'));
    // }
}
