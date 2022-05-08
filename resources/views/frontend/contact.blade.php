@extends('frontend.layout')



@section('title')

إتصل بنا 

@endsection

@section('content')

    <div class="send_notes_page pt-4 pb-4">

        <div class="container">

          		

              <h3 style="text-align: center; margin-bottom: 25px; margin-top:25px">

                تواصل معنا

              </h3>

            <div class="card">

               <div class="card-header"  style="text-align: center;"><h4 class="card-title" style="margin-bottom: 15px; margin-top:15px">
<p>أخي/أختي الكريمة،</h4>
نسعد بملاحظاتكم حيال الموقع وتطويره<br>
 التواصل معنا على 
<div class="fa-hover col-md-3 col-sm-4" style="margin: 0 auto; float: none; margin-bottom: 10px; margin-top:10px">
      <a href="https://iwtsp.com/966554955528">
        <i class="fa fa-whatsapp" aria-hidden="true"></i> <em>واتس اب</em>
      </a>
    </div>
ومن خلال نموذج المراسلة التالي:</p>
</div>

                <div class="card-body">

                    <form action="{{ route('frontend.send_contact') }}" method="POST" enctype="application/x-www-form-urlencoded">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label" for="">الأسم</label>

                            <input class="form-control" name="name" type="text" value="{{ old('name') }}">

                            @error('name')

                            <div class="text-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label" for="">البريد الألكترونى</label>

                            <input class="form-control" name="email" type="email" value="{{ old('email') }}">

                            @error('email')

                            <div class="text-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label" for="">الموضوع</label>

                            <input class="form-control" name="topic" type="text" value="{{ old('topic') }}">

                            @error('topic')

                            <div class="text-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label" for="">الرسالة</label>

                            <textarea class="form-control" rows="10" name="txt">{{ old('txt') }}</textarea>

                            @error('txt')

                            <div class="text-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <div class="g-recaptcha" data-sitekey="6Lep4_cUAAAAAN0WkzblZs9GXzS_aVZAyCt1WLbG"></div>

                            @error('captcha')

                                <div class="text-danger">{{ $message }}</div>

                            @enderror

                            <input class="btn btn-primary mt-2" type="submit" value="ارسال">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection



@section('extra_script')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>



</script>

@endsection