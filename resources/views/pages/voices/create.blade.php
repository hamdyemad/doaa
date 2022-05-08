@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            انشاء صوتيات
          </h1>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{ route('voices.index') }}">الصوتيات</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                انشاء صوتيات
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
            انشاء صوتيات
        </h3>
      </div>
      <div class="block-content">
        <form action="{{ route('voices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label" for="name">العنوان</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="title" value="{{ old('title') }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-12 col-md-6">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label" for="name">الصوت</label>
                        <div class="col-sm-10">
                            <input class="my-pond" id="src" type="file" accept="audio/*" name="src">
                            @error('src')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for=""></label>
                        <input type="submit" value="انشاء" class="btn btn-success">
                        <a class="btn btn-warning" href="{{ route('voices.index') }}">
                            الرجوع الى الصوتيات
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
  <script>
      // Register the plugin
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.create(document.querySelector('.my-pond'), {
        acceptedFileTypes: ['audio/*'],
        fileValidateTypeDetectType: (source, type) =>
        new Promise((resolve, reject) => {
            if(type.startsWith('audio/')) {
                resolve(type);
            } else {
                // Do custom type detection here and return with promise
                reject(type);
            }
        }),
    });
    //     // Turn input element into a pond
    //   $('.my-pond').filepond();
    FilePond.setOptions({
        server: {
            url: "{{ route('voices.store') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        }
    });
  </script>
@endsection
