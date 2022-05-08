<?php

namespace App\Http\Controllers;

use App\Models\Voice;
use App\Traits\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoiceController extends Controller
{


    use File;
  public function index(Request $request){
    $voices = Voice::latest();

    if($request->id) {
        $voices = $voices->where('id', 'like', '%' . $request->id . '%');
    }
    if($request->title) {
        $voices = $voices->where('title', 'like', '%' . $request->title . '%');
    }

    $voices = $voices->paginate(10);
    return view('pages.voices.index',compact('voices'));
  }

  public function create() {
      return view('pages.voices.create');
  }

  public function store(Request $request){
    if($request->hasFile('src')) {
        // get file extenstion
        $fileExt = $request->file('src')->getClientOriginalExtension();
        // rename the filename
        $fileName = uniqid() . '-' . time() . '.' . $fileExt;
        $request->file('src')->move($this->audiosPath, $fileName);
        $storedFileName = $this->audiosPath . $fileName;
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
        Voice::create($creation);
        return redirect()->to(route('voices.index', ['page' => $request->page]))->with('success', 'تم انشاء الصوت بنجاح');
    }
  }

  public function remove_voice_file(Request $request, Voice $voice) {
    if(file_exists($voice->src)) {
        unlink($voice->src);
    }
    $voice->update([
        'src' => ''
    ]);
    return redirect()->back()->with('success', 'تم ازالة الملف بنجاح');
  }




  public function edit(Voice $voice) {
      return view('pages.voices.edit', compact('voice'));
  }

    public function update(Request $request, Voice $voice){
        if($request->hasFile('src')) {
            // get file extenstion
            $fileExt = $request->file('src')->getClientOriginalExtension();
            // rename the filename
            $fileName = uniqid() . '-' . time() . '.' . $fileExt;
            $request->file('src')->move($this->audiosPath, $fileName);
            $storedFileName = $this->audiosPath . $fileName;
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
            $voice->update($creation);
            return redirect()->to(route('voices.index', ['page' => $request->page]))->with('success', 'تم  تعديل الصوت بنجاح');
        }

    }


  //delete method
  public function destroy(Request $request,Voice $voice)
    {
        if(file_exists($voice->src)) {
            unlink($voice->src);
        }
        Voice::destroy($voice->id);
        return redirect()->to(route('voices.index', ['page' => $request->page]))->with('success', 'تمت الأزالة بنجاح');
    }


}
