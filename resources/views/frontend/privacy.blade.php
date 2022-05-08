@extends('frontend.layout')

@section('content')
    <div class="privacy pt-1">
        <div class="container">
            <div class="card mt-4 mb-4">
                <div class="card-header text-center">
                    <h1 class="m-0 p-2">الخصوصية</h1>
                </div>
                @if(get_setting('privacy'))
                    <div class="card-body">
                        @php
                            echo get_setting('privacy')
                        @endphp
                    </div>
                @else
                <div class="alert alert-info text-cente m-0 text-center">لا يوجد خصوصية مضافة</div>
                @endif
            </div>
        </div>
    </div>
@endsection
