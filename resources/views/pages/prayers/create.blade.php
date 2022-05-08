@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            انشاء دعاء
          </h1>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{ route('prayers.index') }}">الأدعية</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                انشاء دعاء
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Your Block -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
            انشاء دعاء
        </h3>
      </div>
      <div class="block-content">
        <form action="{{ route('prayers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3 row">
                        <label for="staticEmail" name="category_id" class="col-sm-2 col-form-label">التصنيف</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="category_id">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
                @if(request('type') == '2')
                    <input type="hidden" value="{{ request('type') }}" name="type">
                    <div class="col-12 col-md-6">
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label" for="name">صور الدعاء</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control input_files" accept="image/*" multiple hidden name="photos[]">
                                <button type="button" class="btn btn-primary form-control files">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                                @error('photos')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="text-danger file_error" hidden>يجب اختيار 5 صور كحد اقصى</div>
                                <div class="imgs mt-2"></div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(request('type') == '1')
                <input type="hidden" value="{{ request('type') }}" name="type">
                    <div class="col-12 col-md-6">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">العبارة الرئيسية</label>
                            <div class="col-sm-10">
                            <input name="main_phrase" type="text" class="form-control" value="{{ old('main_phrase') }}">
                                @error('main_phrase')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-12">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="form-label">النص</label>
                            <div class="col-12">
                                <textarea class="form-control" name="txt" id="txt">{{ old('txt') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">التخريج</label>
                            <div class="col-sm-10">
                            <input name="graduation" type="text" class= "form-control" value="{{ old('graduation') }}">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="mb-3">
                        <label for=""></label>
                        <input type="submit" value="انشاء" class="btn btn-success">
                        <a class="btn btn-warning" href="{{ route('prayers.index') }}">
                            الرجوع الى الأدعية
                        </a>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
    <!-- END Your Block -->
  </div>
  <!-- END Page Content -->
@endsection

@section('js_after')
<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
<script>

CKEDITOR.replace( 'txt', {
    language: 'ar',
    fontSize_defaultLabel: '20px'
});

</script>
@endsection
