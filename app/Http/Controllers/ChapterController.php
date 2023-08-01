<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;
use Carbon\Carbon;  

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $chapter = Chapter::with('truyen')->orderBy('id', 'DESC')->paginate(10);
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.create')->with(compact('truyen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $data = $request->validate(
            [
                'truyen_id' => 'required',
                'tieude' => 'required|unique:chapter|max:255',
                'slug_chapter' => 'required|unique:chapter|max:255',
                'noidung' => 'required',
                // 'tomtat' => 'required',
                'kichhoat' => 'required',
            ],
            [
                'tieude.unique' => 'Tên chapter đã tồn tại (có thể trùng của truyện khác)',
                'slug_chapter.unique' => 'Slug chapter đã tồn tại (có thể trùng của truyện khác)',
                'tieude.required' => 'Phải có tên chapter',
                // 'tomtat.required' => 'Phải có tóm tắt chapter',
                'slug_chapter.required' => 'Phải có slug chapter',
                'noidung.required' => 'Phải có nội dung chapter',
                'truyen_id.required' => 'Phải thuộc cùng truyện'
            ]
        );
        $chapter = new chapter();

        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        // $chapter->tomtat = $data['tomtat'];
        $chapter->noidung = $data['noidung'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->truyen_id = $data['truyen_id'];

        $chapter->save();

        return redirect()->back()->with('status', 'Thêm chapter thành công');
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.edit')->with(compact('truyen', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate(
            [
                'truyen_id' => 'required',
                'tieude' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                'noidung' => 'required',
                // 'tomtat' => 'required',
                'kichhoat' => 'required'
            ],
            [
                'tieude.unique' => 'Tên chapter đã tồn tại (có thể trùng của truyện khác)',
                'slug_chapter.unique' => 'Slug chapter đã tồn tại (có thể trùng của truyện khác)',
                'tieude.required' => 'Phải có tên tên chapter',
                // 'tomtat.required' => 'Phải có tóm tắt chapter',
                'slug_chapter.required' => 'Phải có slug chapter',
                'noidung.required' => 'Phải có nội dung chapter',
                'truyen_id.unique' => 'ID Truyện này nó lạ lắm',
                'truyen_id.required' => "Phải thuộc truyện nào đó"
            ]
        );
        $chapter = Chapter::find($id);

        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        // $chapter->tomtat = $data['tomtat'];
        $chapter->noidung = $data['noidung'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->truyen_id = $data['truyen_id'];

        $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();

        return redirect()->back()->with('status', 'Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Chapter::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa chapter thành công');
    }
}
