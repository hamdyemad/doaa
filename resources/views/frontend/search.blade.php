@extends('frontend.layout')



@section('title')

عميلة البحث

@endsection

@section('content')

    <div class="search_page pt-4 pb-4">

        <div class="container">

            <div class="card">

                <div class="card-body">

                    <div class="row justify-content-center data">

                        @forelse ($prayers as $prayer)

                            <div class="col-12 col-md-6 mb-4">

                                <div class="info">

                                    <h1 class="heading text-center" style="{{config('prayer.main_phrase_css')}}">{{ $prayer->main_phrase }}</h1>

                                    @if($prayer->txt)

                                        <div class="about text-center" style="{{config('prayer.txt_css')}}">

                                            @php

                                                echo $prayer->txt;

                                            @endphp

                                        </div>

                                    @endif

                                    <span class="graduation text-center d-block" style="{{config('prayer.graduation_css')}}">{{ $prayer->graduation }}</span>

                                    <a class="send_notes d-flex text-center btn" href="{{ route('frontend.send_notes_page', $prayer) }}">

                                        <i class="{{config('prayer.icon_class')}}"></i>

                                    </a>

                                </div>

                            </div>

                            @empty

                            <div class="alert alert-primary text-center fw-bold">لا يوجد أدعية بعد</div>

                            @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection