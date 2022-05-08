@extends('frontend.layout')







@section('title')



مكتبة الصوتيات



@endsection



@section('content')



    <div class="category pt-4 pb-4">



        <div class="container">



            <div class="card">



                <div class="card-header">



                    <h3 class="m-0 text-center text-md-right">مكتبة الصوتيات</h3>



                </div>



                <div class="card-body">



                    <div class="row justify-content-center data">



                        @forelse ($voices as $voice)



                            <div class="col-12 col-md-4 mb-4">



                                <div class="info text-center">

                                        @if($voice->title)



                                            <div class="about text-center" style="{{config('prayer.txt_css')}}">


												<h4>


                                                @php



                                                    echo $voice->title;



                                                @endphp



                                            </h4></div>



                                        @endif


                                        <audio controls>
                                            <source src='{{ asset($voice->src) }}' type='audio/mpeg'>
                                        Your browser does not support the audio element.
                                        </audio>


                                        <a class="send_notes d-flex text-center btn" href="{{ route('frontend.send_notes_page', $voice->slug) }}">



                                            <i class="{{config('prayer.icon_class')}}"></i>


                                          <span style="margin-right:3px; margin-left:3px" > {{ $voice->id }} </span>
                                        </a>
                                </div>



                            </div>



                            @empty



                            <div class="alert alert-primary text-center fw-bold">لا يوجد صوتيات بعد</div>



                            @endforelse



                        @if(count($voices) > 0)



                            <!-- Data Loader -->



                            <div class="auto-load text-center">



                                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"



                                    x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">



                                    <path fill="#000"



                                        d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">



                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"



                                            from="0 50 50" to="360 50 50" repeatCount="indefinite" />



                                    </path>



                                </svg>



                            </div>



                        @endif



                    </div>



                </div>



            </div>



        </div>



    </div>



@endsection







@section('extra_script')



<script>

$("audio").bind("play" , function(){
  $("audio").not(this).each(function(index,audio){
    audio.pause();
  });


});





$('.auto-load').hide();

    var ENDPOINT = "{{ url('/') }}";



    var page = 1;



 	var stop = false;



  	var isLoading = false;



    var footer = document.getElementsByTagName('footer')[0];



    $(window).scroll(function () {







        if(stop === false && isLoading === false)



          {







            if ($(window).scrollTop() + $(window).height() + footer.clientHeight + 10 >= ($(document).height())) {



            page++;



              isLoading = true;



            infinteLoadMore(page);



        }



          }



    });



    function infinteLoadMore(page) {



        $.ajax({



                url: ENDPOINT + "/audios/"  + "?page=" + page,



                datatype: "html",



                type: "get",



                beforeSend: function () {



                    // $('.auto-load').show();



                }



            })



            .done(function (response) {



          isLoading = false;



                if (response.length == 0) {



                  stop = true;



                    $('.auto-load').hide();



                    return;



                }



                $('.auto-load').hide();



                $(".data").append(response);



            })



            .fail(function (jqXHR, ajaxOptions, thrownError) {



          isLoading = false;



                console.log('Server error occured');



            });



    }



</script>



@endsection
