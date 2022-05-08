<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Carbon::setLocale('ar');
        $categories = Category::latest();
        if($request->name) {
            $categories = $categories->where('name', 'like', '%'. $request->name .'%');
        }
        $categories = $categories->paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name'
        ], [
            'name.required' => 'أسم التصنيف مطلوب',
            'name.unique' => 'أسم التصنيف هذا موجود من قبل'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        Category::create([
            'name' => $request->name
        ]);
        return redirect()->to(route('categories.index'))->with('success', 'تم انشاء التصنيف بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category->id)]

        ], [
            'name.required' => 'أسم التصنيف مطلوب',
            'name.unique' => 'أسم التصنيف هذا موجود من قبل'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $category->update([
            'name' => $request->name
        ]);
        return redirect()->to(route('categories.index') . '?page=' . $request->page)->with('info', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        foreach ($category->prayers as $prayer) {
            if(file_exists($prayer->photo)) {
                unlink($prayer->photo);
            }
        }
        Category::destroy($category->id);
        return redirect()->back()->with('success', 'تمت الأزالة بنجاح');
    }
}
