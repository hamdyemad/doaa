<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Traits\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{


    use File;
  public function index(Request $request){
    $videos = Video::latest();

    if($request->id) {
        $videos = $videos->where('id', 'like', '%' . $request->id . '%');
    }
    if($request->title) {
        $videos = $videos->where('title', 'like', '%' . $request->title . '%');
    }

    $videos = $videos->paginate(10);
    return view('pages.videos.index',compact('videos'));
  }

  public function create() {
      return view('pages.videos.create');
  }

  public function store(Request $request){
    if($request->hasFile('src')) {
        // get file extenstion
        $fileExt = $request->file('src')->getClientOriginalExtension();
        // rename the filename
        $fileName = uniqid() . '-' . time() . '.' . $fileExt;
        $request->file('src')->move($this->videosPath, $fileName);
        $storedFileName = $this->videosPath . $fileName;
        $request->session()->put('src', $storedFileName);
        return $storedFileName;
    } else {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'src' => 'required'
        ], [
            'title.required' => 'العنوان مطلوب',
            'src.required' => 'الملف مطلوب'

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('error', 'يوجد خطأ ما');
        }
        $creation = [
            'title' => $request->title,
            'slug' => 'm-' . uniqid()
        ];
        if($request->session()->has('src')) {
            $creation['src'] = $request->session()->get('src');
            $request->session()->forget('src');
        }
        Video::create($creation);
        return redirect()->to(route('videos.index', ['page' => $request->page]))->with('success', 'تم انشاء الفيديو بنجاح');
    }
  }

  public function remove_video_file(Request $request, Video $video) {
    if(file_exists($video->src)) {
        unlink($video->src);
    }
    $video->update([
        'src' => ''
    ]);
    return redirect()->back()->with('success', 'تم ازالة الملف بنجاح');
  }




  public function edit(Video $video) {
      return view('pages.videos.edit', compact('video'));
  }

    public function update(Request $request, Video $video){
        if($request->hasFile('src')) {
            // get file extenstion
            $fileExt = $request->file('src')->getClientOriginalExtension();
            // rename the filename
            $fileName = uniqid() . '-' . time() . '.' . $fileExt;
            $request->file('src')->move($this->videosPath, $fileName);
            $storedFileName = $this->videosPath . $fileName;
            $request->session()->put('src', $storedFileName);
            return $storedFileName;
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ], [
                'title.required' => 'العنوان مطلوب'
            ]);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('error', 'يوجد خطأ ما');
            }
            $creation = [
                'title' => $request->title
            ];
            if($request->session()->has('src')) {
                $creation['src'] = $request->session()->get('src');
                $request->session()->forget('src');
            }
            $video->update($creation);
            return redirect()->to(route('videos.index', ['page' => $request->page]))->with('success', 'تم  تعديل الفيديو بنجاح');
        }

    }


  //delete method
  public function destroy(Request $request,Video $video)
    {
        if(file_exists($video->src)) {
            unlink($video->src);
        }
        Video::destroy($video->id);
        return redirect()->to(route('videos.index', ['page' => $request->page]))->with('success', 'تمت الأزالة بنجاح');
    }


}
