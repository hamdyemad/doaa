<?php



namespace App\Http\Controllers\FrontEnd;



use App\Http\Controllers\Controller;

use App\Models\Voice;

use Illuminate\Http\Request;



class VoiceController extends Controller

{

    public function index(request $request) {

        $voices = Voice::latest()->paginate(12);
        $artilces = '';

        if($request->page) {

            foreach ($voices as $voice) {


              		$med = $voice->src;


                    $artilces.= "

                    <div class='col-12 col-md-4 mb-4'>

                        <div class='info text-center'>

                            <div class='about text-center'><h4>$voice->title </h4></div>
                            <div class='audio'>
                            	<audio controls>
                                            <source src='$med' type='audio/mpeg'>
                                        Your browser does not support the audio element.
                                        </audio>
                            </div>
                            <a class='send_notes d-flex text-center btn' href='/send_notes/$voice->slug'>

                                <i class='".config('prayer.icon_class')."'></i>
                                <span style='margin-right:3px; margin-left:3px'>  $voice->id </span>

                            </a>

                        </div>

                    </div>
                ";

            }

            return $artilces;


        } else {

            return view('frontend.voice', compact('voices'));

        }

    }



}
