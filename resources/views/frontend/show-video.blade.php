@extends('frontend.layout')







@section('title')


{{$video->title}}



@endsection



@section('content')



    <div class="category pt-4 pb-4">



        <div class="container">



            <div class="card">



                <div class="card-header">
                    <h3 class="m-0 text-center text-md-right">   مكتبة الفيديو |  {{$video->title}}</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center data">



                            <div class="col-12 col-md-12 mb-12">



                                <div class="info text-center">


                                         <video controls height="500" width="100%">
                                          <source src="{{ asset($video->src) }}" type="video/mp4">
                                          Your browser does not support the video tag.
                                        </video>



                                        @if($video->title)



                                            <div class="about text-center" style="{{config('prayer.txt_css')}}">

											<h4>



                                                @php



                                                    echo $video->title;



                                                @endphp



                                            </h4></div>



                                        @endif


                                        <a class="send_notes d-flex text-center btn" href="{{ route('frontend.send_notes_page', $video->slug) }}">



                                            <i class="{{config('prayer.icon_class')}}"></i>


                                          <span style="margin-right:3px; margin-left:3px" > {{ $video->id }} </span>
                                        </a>



                                    {{-- @endif --}}



                                </div>



                            </div>



                    </div>



                </div>



            </div>



        </div>



    </div>



@endsection







@section('extra_script')



<script>





@endsection
