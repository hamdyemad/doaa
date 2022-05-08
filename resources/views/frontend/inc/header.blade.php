<section class="header">
    @php
        $headers = App\Models\Header::all();
    @endphp
    <div class="header_carousel owl-carousel owl-theme">
        @foreach ($headers as $header)
            <div class="item">
                <img src="{{ asset($header->photo) }}" alt="يوجد خطأ فى عرض الصورة">
            </div>
        @endforeach
    </div>
</section>
