@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            تعديل الفيديو
          </h1>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{ route('videos.index') }}">الفيديو</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                تعديل الفيديو
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
            تعديل الفيديو
        </h3>
      </div>
      <div class="block-content">
        <form id="form" action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="page" value="{{ request('page') }}">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label" for="name">العنوان</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="title" value="{{ $video->title }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-12 col-md-6">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label" for="name">الفيديو</label>
                        <div class="col-sm-10">
                            <input class="my-pond" id="src" type="file" accept="video/*" name="src">
                            @error('src')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            @if($video->src)
                <ul class="list-unstyled p-0 m-0">
                    <li class="d-flex align-items-center mb-2">
                        <form class="d-flex align-items-center mb-2" action="{{ route('videos.remove_video_file', $video) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <span class="alert alert-primary ms-2 d-block">{{ $video->src }}</span>
                            <button class="btn btn-danger">ازالة</button>
                        </form>
                    </li>
                </ul>
            @endif
            <div class="col-12">
                <div class="mb-3">
                    <label for=""></label>
                    <input type="submit" value="تعديل" class="btn btn-success" form="form">
                    <a class="btn btn-warning" href="{{ route('videos.index') }}">
                        الرجوع الى الفيديوهات
                    </a>
                </div>
            </div>
        </div>
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
        acceptedFileTypes: ['video/*'],
        fileValidateTypeDetectType: (source, type) =>
        new Promise((resolve, reject) => {
            if(type.startsWith('video/')) {
                resolve(type);
            } else {
                // Do custom type detection here and return with promise
                reject(type);
            }
        }),
    });
    //     // Turn input element into a pond
    FilePond.setOptions({
        server: {
            url: "/admin/videos/{{ $video->id }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        }
    });
  </script>
@endsection
