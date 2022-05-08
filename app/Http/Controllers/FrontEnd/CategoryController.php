<?php



namespace App\Http\Controllers\FrontEnd;



use App\Http\Controllers\Controller;

use App\Models\Category;

use Illuminate\Http\Request;



class CategoryController extends Controller

{

    public function category(Request $request,Category $category) {

        if($category->prayers[0]->has_photo) {
            $prayers = $category->prayers()->inRandomOrder()->paginate(10);
        } else {
            $prayers = $category->prayers()->paginate(10);
        }
        $artilces = '';

        if($request->page) {

            foreach ($prayers as $prayer) {

                if($prayer->has_photo) {

                    $artilces.= "

                        <div class='col-12 col-md-6 mb-4'>

                            <div class='info'>

                                <img src='/$prayer->photo' alt='يوجد مشكلة فى الصورة'>

                            </div>

                        </div>

                    ";

                } else {

                    $artilces.= "

                    <div class='col-12 col-md-6 mb-4'>

                        <div class='info'>

                            <h1 class='heading text-center' style='".config('prayer.main_phrase_css')."'>$prayer->main_phrase</h1>

                            <div class='about text-center' style='".config('prayer.txt_css')."'>$prayer->txt</div>

                            <span class='graduation text-center d-block' style='font-size: 10px; padding-top: 20px; font-family: Amiri, serif; color:#b0b2b3;'>$prayer->graduation</span>

                            <a class='send_notes d-flex text-center btn' href='/send_notes/$prayer->id'>

                                <i class='".config('prayer.icon_class')."'></i>
                                <span style='margin-right:3px; margin-left:3px'>  $prayer->id </span>

                            </a>

                        </div>

                    </div>

                ";

                }

            }

            return $artilces;

        } else {

            return view('frontend.category', compact('prayers', 'category'));

        }

    }



}
