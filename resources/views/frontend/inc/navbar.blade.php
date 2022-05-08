<nav class="navbar navbar-expand-lg p-0 fixed-top">



    <div class="container">



        <div class="upper_nav">







            <form class="d-none d-md-flex search" action="{{ route('frontend.search') }}" method="GET">



                <button class="btn">بحث</button>



                <input class="form-control" name="txt" value="{{ request('txt') }}" placeholder="أدخل كلمة البحث" type="text">



            </form>







            <a class="navbar-brand animated fadeInRight" href="{{ route('frontend.home') }}">



                @if (get_setting('logo'))



                    <img src="{{ asset(get_setting('logo')) }}">



                @else



                    <img src="{{ URL::asset('/media/default.png') }}">



                @endif



            </a>



            <div class="navbar-toggler animated fadeInLeft" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-bs-controls="navbarSupportedContent" aria-bs-expanded="false" aria-bs-label="Toggle navigation">



                <span></span>



                <span></span>



                <span></span>



            </div>



        </div>



    </div>



    <div class="collapse navbar-collapse animated fadeInLeft" id="navbarSupportedContent">



        <div class="container">



            <ul class="navbar-nav ml-auto">



                <li class="nav-item d-flex d-md-none">



                    <a class="nav-link">



                        <form class="search" action="{{ route('frontend.search') }}" method="GET">



                            <button class="btn">بحث</button>



                            <input class="form-control" name="txt" value="{{ request('txt') }}" placeholder="أدخل كلمة البحث" type="text">



                        </form>



                    </a>



                </li>



                <li class="nav-item">



                    <a class="nav-link @if(activeRoute('frontend.home')) active_link  @endif" href="{{ route('frontend.home') }}">

                        الرئيسية

                    </a>

                </li>



              

                <li class="nav-item">



                  <a class="nav-link @if(activeRoute('frontend.contact')) active_link @endif" href="{{



 route('frontend.contact') }}"> 



                             



                   إتصل بنا 



                             </a>



                             </li>



                @php



                    $categories = \App\Models\Category::all();



                @endphp



       



  @foreach ($categories as $category)

                <li class="nav-item">

                    <a class="nav-link @if(activeRoute('frontend.category') && request()->route('category')->id == $category->id) active_link  @endif" href="{{ route('frontend.category', $category) }}">

                        {{ $category->name }}

                    </a>

                </li>

                @endforeach




              



<li class="nav-item">

   <a class="nav-link @if(activeRoute('frontend.audios')) active_link @endif" href="{{

      route('frontend.audios') }}"> 

   الصوتيات

   </a>

</li>

              

              <li class="nav-item">

   <a class="nav-link @if(activeRoute('frontend.videos')) active_link @endif" href="{{

      route('frontend.videos') }}"> 

   الفديوهات

   </a>

</li>



              



            </ul>



        </div>



    </div>



</nav>