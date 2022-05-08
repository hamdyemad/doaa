@extends('layouts.simple')

@section('title')
تسجيل الدخول
@endsection

@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">
                            <h3 class="text-center mt-4">
                                @if (get_setting('logo'))
                                    <a href="/" class="logo logo-admin"><img src="{{ asset(get_setting('logo')) }}"
                                            height="30" alt="logo"></a>
                                @else
                                    <a href="/" class="logo logo-admin"><img src="{{ URL::asset('/media/default.png') }}"
                                            height="30" alt="logo"></a>
                                @endif
                            </h3>
                            <form method="POST" class="form-horizontal mt-4" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="username">البريد الألكترونى</label>
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus
                                        placeholder="البريد الألكترونى">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">الرقم السرى</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password" placeholder="الرقم السرى">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row mt-2">
                                    <div class="col-6 text-right">
                                        <button class="btn btn-primary w-md waves-effect waves-light"
                                            type="submit">تسجيل الدخول</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
