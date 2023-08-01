<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;

class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $danhmuctruyen = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $danhmuctruyen = DanhmucTruyen::all();
        return view('admincp.danhmuctruyen.index')->with(compact('danhmuctruyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admincp.danhmuctruyen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'tendanhmuc' => 'required|unique:danhmuc|max:255',
            'slug_danhmuc' => 'required|unique:danhmuc|max:255',
            'mota' => 'required|max:255',
            'kichhoat' => 'required'
        ],
        [
            'tendanhmuc.unique' => 'Tên danh mục đã tồn tại, xin điền tên khác',
            'slug_danhmuc.unique' => 'Slug danh mục đã tồn tại, xin điền slug khác',
            'tendanhmuc.required' => 'Phải có tên danh mục',
            'mota.required' => 'Phải có mô tả danh mục'
        ]
    );
    $danhmuctruyen = new DanhmucTruyen();
    
    $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
    $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
    $danhmuctruyen->mota = $data['mota'];
    $danhmuctruyen->kichhoat = $data['kichhoat'];

    $danhmuctruyen->save();

    return redirect()->back()->with('status', 'Thêm danh mục truyện thành công');
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
        $danhmuc = DanhmucTruyen::find($id);
        return view('admincp.danhmuctruyen.edit')->with(compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'tendanhmuc' => 'required|max:255',
            'slug_danhmuc' => 'required|max:255',
            'mota' => 'required|max:255',
            'kichhoat' => 'required'
        ],
        [
            'tendanhmuc.required' => 'Phải có tên danh mục',
            'slug_danhmuc.required' => 'Phải có slug danh mục',
            'mota.required' => 'Phải có mô tả danh mục'
        ]
    );
    $danhmuctruyen = DanhmucTruyen::find($id);

    $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
    $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
    $danhmuctruyen->mota = $data['mota'];
    $danhmuctruyen->kichhoat = $data['kichhoat'];

    $danhmuctruyen->save();

    return redirect()->back()->with('status', 'Cập nhật danh mục truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DanhmucTruyen::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa danh mục truyện thành công');
    }
}
