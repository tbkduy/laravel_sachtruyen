<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use Carbon\Carbon;  

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list_truyen = Truyen::with('danhmuctruyen')->orderBy('id', 'DESC')->get();
        return view('admincp.truyen.index')->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.truyen.create')->with(compact('danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'tentruyen' => 'required|unique:truyen|max:255',
            'slug_truyen' => 'required|unique:truyen|max:255',
            'hinhanh' => 'required|image|mimes:jpg,png, jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'tomtat' => 'required',
            'tacgia' => 'required',
            'kichhoat' => 'required',
            'danhmuc' => 'required'
        ],
        [
            'tentruyen.unique' => 'Tên truyện đã tồn tại',
            'slug_truyen.unique' => 'Slug truyện đã tồn tại',
            'tentruyen.required' => 'Phải có tên truyện',
            'tomtat.required' => 'Phải có tóm tắt truyện',
            'tacgia.required' => 'Phải có tác giả',
            'slug_truyen.required' => 'Phải có slug truyện',
            'hinhanh.required' => 'Phải có hình ảnh truyện'
        ]
    );
    $truyen = new Truyen();
    
    $truyen->tentruyen = $data['tentruyen'];
    $truyen->slug_truyen = $data['slug_truyen'];
    $truyen->tomtat = $data['tomtat'];
    $truyen->kichhoat = $data['kichhoat'];
    $truyen->tacgia = $data['tacgia'];
    $truyen->danhmuc_id = $data['danhmuc'];

    $truyen_created_at = Carbon::now('Asia/Ho_Chi_Minh');

    //thêm ảnh vào folder
    $get_image = $request->hinhanh;
    $path = 'public/uploads/truyen/';
    $get_name_image = $get_image->getClientOriginalName(); 
    $name_image = current(explode('.', $get_name_image));
    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    $get_image->move($path, $new_image);

    $truyen->hinhanh = $new_image;

    $truyen->save();

    return redirect()->back()->with('status', 'Thêm truyện thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $truyen = Truyen::find($id);
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.truyen.edit')->with(compact('truyen','danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'tentruyen' => 'required|max:255',
            'slug_truyen' => 'required|max:255',
            'tomtat' => 'required',
            'tacgia' => 'required',
            'kichhoat' => 'required',
            'danhmuc' => 'required'
        ],
        [
            'tentruyen.required' => 'Phải có tên truyện',
            'tomtat.required' => 'Phải có tóm tắt truyện',
            'slug_truyen.required' => 'Phải có slug truyện',
        ]
    );
    $truyen = Truyen::find($id);
    
    $truyen->tentruyen = $data['tentruyen'];
    $truyen->slug_truyen = $data['slug_truyen'];
    $truyen->tomtat = $data['tomtat'];
    $truyen->kichhoat = $data['kichhoat'];
    $truyen->tacgia = $data['tacgia'];
    $truyen->danhmuc_id = $data['danhmuc'];

    $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

    //thêm ảnh vào folder
    $get_image = $request->hinhanh;
    if($get_image){
        $path = 'public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $truyen->hinhanh = $new_image;
    }
    $truyen->save();

    return redirect()->back()->with('status', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        Truyen::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa truyện thành công');
    }
}
