@extends('frontend.layout')

@section('title')
    ارسال ملاحظات
@endsection
@section('content')
    <div class="send_notes_page pt-4 pb-4">
        <div class="container">
            <div class="card">
                <div class="card-header">ارسال ملحوظة حيال: {{ $txt }}</div>
                <div class="card-body">
                    <form action="{{ route('frontend.send_notes') }}" method="POST" enctype="application/x-www-form-urlencoded">
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
                            <label class="form-label" for="">العنوان</label>
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
