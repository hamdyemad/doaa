<footer>



    <div class="container">



        <div class="row pt-2 pb-2 align-items-center">



            <div class="col-12 col-md-4">



                <div class="logo">



                    @if (get_setting('logo'))



                        <img src="/uploads/settings/logo_foto.jpg">



                    @else



                        <img src="{{ URL::asset('/media/default.png') }}">



                    @endif



                </div>



                @if(get_setting('description'))



                <p class="mt-2 wow fadeInUp">{{ get_setting('description') }}</p>


                @endif

            </div>







           



 <div class="col-12 col-md-4">



                <div class="all_links d-block d-md-flex">



                                        <ul class="links">



      <li>



                            <span>دعاء</span>



                        </li>



                                          <li><a href="{{ route('frontend.contact') }}"> اتصل بنا</a></li>
                                          <li> <a href="{{ route('frontend.privacy') }}">سياسة الخصوصية</a> </li>

    



                                        </ul> 



        </div>



    </div>

      <div class="col-12 col-md-4">

                <div class="all_links d-block d-md-flex">

                    @php

                        $categories = \App\Models\Category::all();

                    @endphp

                    <ul class="links">

                        <li>

                            <span>التصنيفات</span>

                        </li>

                        @foreach ($categories as $category)

                            <li>

                                <a href="{{ route('frontend.category', $category) }}">{{ $category->name }}</a>

                            </li>

                        @endforeach
                                           <li><a href="{{ route('frontend.audios') }}"> الصوتيات </a></li>

                                           <li><a href="{{ route('frontend.videos') }}">  الفديوهات</a></li>

                    </ul>



                                        





                </div>

            </div>

        </div>



    </div>



    <div class="downer text-center">



        <h6 class="m-0">تنفيذ الكريدا، {{ date('Y') . '-' . date('Y') + 1 }}&copy;</h6>



    </div>



</footer>