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
@endsection

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            كل الأدعية
          </h1>
        </div>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-content block-content-full">
            <form action="{{ route('prayers.index') }}" method="GET">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <input class="form-control" value="{{ request('id') }}" name="id" type="text" placeholder="رقم الدعاء">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <select class="form-select" name="category_id">
                                    <option value="">أختر التصنيف</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == request('category_id')) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <input class="form-control" value="{{ request('main_phrase') }}" name="main_phrase" type="text" placeholder="العبارة الرئيسية">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <input class="form-control" value="{{ request('txt') }}" name="txt" type="text" placeholder="النص">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <input class="form-control" value="{{ request('graduation') }}" name="graduation" type="text" placeholder="التخريج">
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
                  <th>التصنيف</th>
                  <th>صورة الدعاء الرئيسية</th>
                  <th>العبارة الرئيسية</th>
                  <th>النص</th>
                  <th>التخريج</th>
                  <th>الأعدادات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($prayers as $prayer)
                    <tr>
                        <td>{{ $prayer->id }}</td>
                        <td>
                            {{ $prayer->category->name }}</td>
                        <td>
                            @if ($prayer->photo !== null)
                                <img class="mt-2" src="{{ asset($prayer->photo) }}" alt="">
                            @else
                            دعاء مقالى
                            @endif
                        </td>
                        <td>
                            @if(strlen($prayer->main_phrase) > 20)
                                {{ mb_substr($prayer->main_phrase, 0, 20) . '...' }}
                            @else
                                {{ $prayer->main_phrase }}
                            @endif
                        </td>
                        <td>
                            {{ strip_tags($prayer->txt) }}
                        </td>
                        <td>
                            {{ $prayer->graduation }}
                        </td>
                        <td>


                            <div class="options d-flex">
                                @if($prayer->has_photos == 0)
                                    <a class="btn btn-info ms-2"
                                        href="{{ route('prayers.edit', $prayer) . '?page=' . request('page') }}">
                                        <span>تعديل</span>
                                        <span class="mdi mdi-circle-edit-outline"></span>
                                    </a>
                                @endif
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal_{{ $prayer->id }}">
                                    <span>ازالة</span>
                                    <span class="mdi mdi-delete-outline"></span>
                                </button>
                                <!-- Modal -->
                                @include('layouts.partials.modal', [
                                'id' => $prayer->id,
                                'route' => route('prayers.destroy', $prayer->id)
                                ])
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            {{ $prayers->appends(request()->all())->links() }}
        </div>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
  <!-- END Page Content -->
@endsection
