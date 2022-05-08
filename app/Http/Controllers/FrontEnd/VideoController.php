<?php



namespace App\Http\Controllers\FrontEnd;



use App\Http\Controllers\Controller;

use App\Models\Video;

use Illuminate\Http\Request;



class VideoController extends Controller

{

    public function index(request $request) {

        $videos = Video::latest()->paginate(12);

        $artilces = '';

        if($request->page) {

            foreach ($videos as $video) {

              		$med = $video->src;


                    $artilces.= "

                    <div class='col-12 col-md-6 mb-4'>

                        <div class='info text-center'>
                            <a>
                                <video controls height='300' width='100%'>
                                    <source src='$med'>
                                        Your browser does not support the audio element.
                                </video>
                            </a>
                            <div class='about text-center'>
                                <h4 class='m-0 me-2'>$video->title</h4>
                            </div>
                            <a class='send_notes d-flex text-center btn' href='/send_notes/$video->slug'>

                                <i class='".config('prayer.icon_class')."'></i>
                                <span style='margin-right:3px; margin-left:3px'>  $video->id </span>

                            </a>

                        </div>

                    </div>
                ";

            }

            return $artilces;


        } else {

            return view('frontend.video', compact('videos'));

        }

    }


  	public function show($videor){

      $video = Video::where('id',$videor)->first();

      if($video){
        return view('frontend.show-video', compact('video'));
      }else{
        return redirect()->route('frontend.videos');
      }



    }



}
