@extends('layouts.backend')

@section('css_before')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('js_after')
  <!-- jQuery (required for DataTables plugin) -->
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

  <!-- Page JS Plugins -->
  <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

  <!-- Page JS Code -->
  <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
  <script>
      $("video").bind("play" , function(){
            $("video").not(this).each(function(index,video){
                video.pause();
            });
        });
  </script>
@endsection

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            كل الفيديوهات
          </h1>
        </div>
        <a href="{{ route('videos.create') }}" class="btn btn-success">انشاء فيديو</a>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-content block-content-full">
            <form action="{{ route('videos.index') }}" method="GET">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <input class="form-control" value="{{ request('id') }}" name="id" type="text" placeholder="رقم الملف">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <input class="form-control" value="{{ request('title') }}" name="title" type="text" placeholder="العنوان">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <input class="btn btn-success w-100" type="submit" value="بحث">
                        </div>
                    </div>
                </div>
            </form>
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
              <thead>
                <tr>
                  <th>#</th>
                  <th>العنوان</th>
                  <th>الفيديو</th>
                  <th>وقت الأنشاء</th>
                  <th>وقت التعديل</th>
                  <th>الأعدادات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->title }}</td>
                        <td>
                            @if($video->src)
                                <video controls height="200" width="400">
                                    <source src="{{ asset($video->src) }}">
                                    المتصفح لا يدعم ال audiio
                                </video>
                            @else
                                <div class="alert alert-info">لا يوجد ملف صوت</div>
                            @endif
                        </td>
                        <td>{{ $video->created_at->diffForHumans() }}</td>
                        <td>{{ $video->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="options d-flex">
                                <a class="btn btn-info ms-2"
                                    href="{{ route('videos.edit', $video) . '?page=' . request('page') }}">
                                    <span>تعديل</span>
                                    <span class="mdi mdi-circle-edit-outline"></span>
                                </a>
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal_{{ $video->id }}">
                                    <span>ازالة</span>
                                    <span class="mdi mdi-delete-outline"></span>
                                </button>
                                <!-- Modal -->
                                @include('layouts.partials.modal', [
                                'id' => $video->id,
                                'route' => route('videos.destroy', $video->id)
                                ])
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            {{ $videos->appends(request()->all())->links() }}
        </div>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
  <!-- END Page Content -->
@endsection
