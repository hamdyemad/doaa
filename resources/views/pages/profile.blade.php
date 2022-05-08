@extends('layouts.backend')

@section('title')
تعديل الحساب
@endsection

@section('content')
    <div class="update_user">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    تعديل الحساب
                </div>
                <div class="card-body">
                    <form class="form-horizontal mt-4" method="POST" action="{{ route('profile_update', $user) }}"
                        enctype="multipart/form-data">
                        @method("PATCH")
                        @csrf
                        <input type="hidden" name="profile" value="1">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="useremail">البريد الألكترونى</label>
                                    <input type="email" name="email" class="form-control" name="email"
                                        value="{{ $user->email }}" id="useremail" placeholder="أدخل البريد الألكترونى"
                                        autocomplete="email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">الرقم السرى</label>
                                    <input type="password" class="form-control" name="password"
                                        autocomplete="new-password" id="userpassword" placeholder="ادخل الرقم السرى">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6"></div>

                            <div class="col">
                                <div class="mb-3">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">تعديل
                                        الحساب</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-info">الرجوع الى
                                        لوحة التحكم</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
