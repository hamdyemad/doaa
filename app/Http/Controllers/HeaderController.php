<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Traits\File;
use App\Traits\Res;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeaderController extends Controller
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
        $headers = Header::latest()->get();
        return view('pages.headers.index', compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.headers.create');
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
            'photos' => 'required',
        ];
        $validator_array_msgs = [
            'photos.required' => 'الصور مطلوبة',
        ];

        $validator = Validator::make($request->all(), $validator_array, $validator_array_msgs);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('error', 'يوجد خطأ ما');
        }
        foreach ($request->file('photos') as $photo) {
            Header::create([
                'photo' => $this->uploadFiles($photo, $this->headersPath)
            ]);
        }
        return redirect()->back()->with('success', 'تم اضافة الصور بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Header $header)
    {
        return view('pages.prayers.edit', compact('header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Header $header)
    {
        if(file_exists($header->photo)) {
            unlink($header->photo);
        }
        Header::destroy($header->id);
        return redirect()->back()->with('success', 'تمت الأزالة بنجاح');
    }
}
