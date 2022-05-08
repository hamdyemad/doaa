<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Prayer;
use App\Traits\File;
use App\Traits\Res;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrayerController extends Controller
{

    use File, Res;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Carbon::setLocale('ar');
        $prayers = Prayer::latest();
        $categories = Category::all();
        if($request->id) {
            $prayers = $prayers->where('id', 'like', '%' . $request->id . '%');
        }
        if($request->category_id) {
            $prayers = $prayers->where('category_id', $request->category_id);
        }
        if($request->main_phrase) {
            $prayers = $prayers->where('main_phrase', 'like', '%'.$request->main_phrase.'%');
        }
        if($request->txt) {
            $prayers = $prayers->where('txt', 'like', '%'.$request->txt.'%');
        }
        if($request->graduation) {
            $prayers = $prayers->where('graduation', 'like', '%'.$request->graduation.'%');
        }
        $prayers = $prayers->paginate(5);
        return view('pages.prayers.index', compact('prayers', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        if(count($categories) > 0) {
            return view('pages.prayers.create', compact('categories'));
        } else {
            return redirect(route('categories.create'))->with('error', 'يجب اضافة تصنيفات أولا');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator_array = [
            'category_id' => 'required|exists:categories,id',
        ];
        $validator_array_msgs = [
            'category_id.required' => 'التصنيف مطلوب',
            'category_id.exists' => 'التصنيف غير موجود',
        ];
        if($request->type == '2') {
            $validator_array['photos'] = 'required';
            $validator_array_msgs['photos.required'] = 'الصور  مطلوبة';

        } else {
            $validator_array['main_phrase'] = 'required';
            $validator_array_msgs['main_phrase.required'] = 'العبارة الرئيسية مطلوبة';

        }
        $validator = Validator::make($request->all(), $validator_array, $validator_array_msgs);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('error', 'يوجد خطأ ما');
        }
        $creation = [
            'category_id' => $request->category_id,
            'main_phrase' => $request->main_phrase,
            'txt' => $request->txt,
            'graduation' => $request->graduation,
        ];
        $photos = [];
        if($request->has('photos')) {
            foreach ($request->file('photos') as $photo) {
                Prayer::create([
                    'category_id' => $request->category_id,
                    'has_photo' => 1,
                    'photo' => $this->uploadFiles($photo, $this->prayersPath)
                ]);
            }
        } else {
            $prayer = Prayer::create($creation);
        }
        return redirect()->to(route('prayers.index'))->with('success', 'تم انشاء الدعاء بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Prayer $prayer)
    {
        $categories = Category::all();
        return view('pages.prayers.edit', compact('prayer', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, Prayer $prayer) {
        $validator_array = [
            'category_id' => 'required|exists:categories,id'
        ];
        $validator_array_msgs = [
            'category_id.required' => 'التصنيف مطلوب',
            'category_id.exists' => 'التصنيف غير موجود'
        ];
        if(!$prayer->has_photo) {
            $validator_array['main_phrase'] = 'required';
            $validator_array_msgs['main_phrase.required'] = 'العبارة الرئيسية مطلوبة';
        }
        $validator = Validator::make($request->all(), $validator_array, $validator_array_msgs);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('error', 'يوجد خطأ ما');
        }
        if($request->photo) {
            if(file_exists($prayer->photo)) {
                unlink($prayer->photo);
            }
            $creation = [
                'category_id' => $request->category_id,
                'photo' => $this->uploadFile($request, $this->prayersPath, 'photo')
            ];
        } else {
            $creation = [
                'category_id' => $request->category_id,
                'main_phrase' => $request->main_phrase,
                'txt' => $request->txt,
                'graduation' => $request->graduation,
            ];
        }
        $prayer->update($creation);
        return redirect()->to(route('prayers.index') . '?page=' . $request->page)->with('info', 'تم تعديل الدعاء بنجاح');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prayer $prayer)
    {
        if(file_exists($prayer->photo)) {
            unlink($prayer->photo);
        }
        Prayer::destroy($prayer->id);
        return redirect()->back()->with('success', 'تمت الأزالة بنجاح');
    }
}
