@extends('frontend.layout')







@section('content')



    <div class="home">



        @include('frontend.inc.header')



        <div class="container">



            <div class="card mt-4 mb-4">



                @if(get_setting('article'))



                    <div class="card-header">



                        @php



                            echo get_setting('article');



                        @endphp



                    </div>



                @endif



            </div>



            <div class="all_prayers">



                <div class="card mb-4">



                    <div class="card-body">



                        <div class="row justify-content-center data">



                            @forelse ($prayers as $prayer)



                                <div class="col-12 col-md-6 mb-4">



                                    <div class="info">



                                        <h1 class="heading text-center" style="{{config('prayer.main_phrase_css')}}">{{ $prayer->main_phrase }}</h1>



                                        @if($prayer->txt)



                                            <div class="h3 about text-center" style="{{config('prayer.txt_css')}}">



                                                @php



                                                    echo $prayer->txt;



                                                @endphp



                                            </h3></div>



                                        @endif



                                        <span class="graduation text-center d-block" style="{{config('prayer.graduation_css')}}">{{ $prayer->graduation }}</span>



                                        <a class="send_notes d-flex text-center btn" href="{{ route('frontend.send_notes_page', $prayer) }}">



                                            <i class="{{config('prayer.icon_class')}}"></i>

<span style="margin-left:3px; margin-right:3px">  
             {{ $prayer->id }}
             </span>

                                        </a>



                                    </div>



                                </div>



                                @empty



                                <div class="alert alert-primary text-center fw-bold">لا يوجد أدعية بعد</div>



                                @endforelse



                            @if(count($prayers) > 0)



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



    </div>



@endsection







@section('extra_script')



    <script>



        $('.auto-load').hide();



var ENDPOINT = "{{ url('/') }}";



    var page = 1;



      var stop = false;



      var isLoading = false;



      var footer = document.getElementsByTagName('footer')[0];



    $(window).scroll(function () {



      



        if(stop === false && isLoading === false)



          {



            if ($(window).scrollTop() + $(window).height() + footer.clientHeight + 10 >= ($(document).height() - 1)) {



            page++;



          isLoading = true;



            infinteLoadMore(page);



        }



          }



    });



    function infinteLoadMore(page) {



        $.ajax({



                url: ENDPOINT + "?page=" + page,



                datatype: "html",



                type: "get",



                beforeSend: function () {



                    $('.auto-load').show();



                }



            })



            .done(function (response) {



          isLoading = false;



                if(typeof(response) == 'string') {



                    $('.auto-load').hide();



                }



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



        $('.header_carousel').owlCarousel({



            loop: true,



            rtl: true,



            nav:true,



            responsive:{



                0:{



                    items:1



                },



                2000: {



                    items: 1



                }



            }



        })



    </script>



@endsection