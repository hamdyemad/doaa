<?php



namespace App\Http\Controllers\FrontEnd;



use App\Http\Controllers\Controller;

use App\Mail\SendNotes;

use App\Models\Prayer;
use App\Models\Video;
use App\Models\Voice;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;



class HomeController extends Controller

{



    public function home_page(Request $request) {

        $prayers = Prayer::where('has_photo', 0)->inRandomOrder()->paginate(10);

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

            return view('frontend.home', compact('prayers'));

        }

    }



    public function search(Request $request) {

        $prayers = Prayer::where('has_photo', 0)->where('txt', 'like', '%' . $request->txt . '%')->latest()->paginate(6);

        $artilces = '';

        if($request->page) {

            foreach ($prayers as $prayer) {

                $artilces.= "

                <div class='col-12 col-md-6 mb-4'>

                        <div class='info'>

                            <h1 class='heading text-center' style='".config('prayer.main_phrase_css')."'>$prayer->main_phrase</h1>

                            <div class='about text-center' style='".config('prayer.txt_css')."'>$prayer->txt</div>

                            <span class='graduation text-center d-block' style='".config('prayer.graduation')."'>$prayer->graduation</span>

                            <a class='send_notes d-flex text-center btn' href='/send_notes/$prayer->id'>

                                <i class='".config('prayer.icon_class')."'></i>
                                <span style='margin-right:3px; margin-left:3px'>  $prayer->id </span>

                            </a>

                        </div>

                    </div>";

            }

            return $artilces;

        } else {

            return view('frontend.search', compact('prayers'));

        }

    }



    public function send_notes_page(Request $request, $id) {
        $prayer = Prayer::find($id);
        $voice = Voice::where('slug',$id)->first();
        $video = Video::where('slug',$id)->first();
        if($prayer) {
            $txt = $prayer->txt;
        }
        if($voice) {
            $txt = $voice->title;
        }
        if($video) {
            $txt = $video->title;
        }
        return view('frontend.send_notes', compact('txt'));

    }



    public function privacy() {

        return view('frontend.privacy');

    }


    //  Baik Edit Start
    public function contact(){

      return view('frontend.contact');

    }

    public function send_contact(Request $request){

      $email = \config('contactemail.contactemail');

      $captcha = $request['g-recaptcha-response'];

        $res = Http::post("https://www.google.com/recaptcha/api/siteverify?secret=6Lep4_cUAAAAAHBBgGQFN7lSLxG_icaoIIOfQ1Qy&response=$captcha");

        $validator_array = [

            'name' => 'required',

            'email' => 'required|email',

            'topic' => 'required',

            'txt' => 'required'

        ];

        $validator_messages = [

            'name.required' => 'الأسم مطلوب',

            'email.required' => 'البريد الألكترونى مطلوب',

            'email.email' => 'البريد الألكترونى يجب ان يكون من نوع ميل',

            'topic.required' => 'الموضوع مطلوب',

            'txt.required' => 'النص مطلوب',

        ];

        if($res['success'] == false) {

            $validator_array['captcha'] = 'required';

            $validator_messages['captcha.required'] = 'يوجد مشكلة فى التحقق';

        }

        $validator = Validator::make($request->all(), $validator_array, $validator_messages);

        if($validator->fails()) {

            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());

        }

        try {

            Mail::to($email)->send(new SendNotes($request->all()));

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'لم يتم الأرسال يوجد مشكلة  ');

        }

        return redirect()->back()->with('success', 'تم الارسال بنجاح | سيتم التواصل معك قريبا');

    }

    // Baik Edit End



    public function send_notes(Request $request) {
        $captcha = $request['g-recaptcha-response'];

        $res = Http::post("https://www.google.com/recaptcha/api/siteverify?secret=6Lep4_cUAAAAAHBBgGQFN7lSLxG_icaoIIOfQ1Qy&response=$captcha");

        $validator_array = [

            'name' => 'required',

            'email' => 'required|email',

            'topic' => 'required',

            'txt' => 'required'

        ];

        $validator_messages = [

            'name.required' => 'الأسم مطلوب',

            'email.required' => 'البريد الألكترونى مطلوب',

            'email.email' => 'البريد الألكترونى يجب ان يكون من نوع ميل',

            'topic.required' => 'الموضوع مطلوب',

            'txt.required' => 'النص مطلوب',

        ];

        if($res['success'] == false) {

            $validator_array['captcha'] = 'required';

            $validator_messages['captcha.required'] = 'يوجد مشكلة فى التحقق';

        }

        $validator = Validator::make($request->all(), $validator_array, $validator_messages);

        if($validator->fails()) {

            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());

        }

        try {

            Mail::to($request['email'])->send(new SendNotes($request->all()));

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'لم يتم الأرسال يوجد مشكلة فى الميل');

        }

        return redirect()->back()->with('success', 'تم الأرسال بنجاح');

    }

}
