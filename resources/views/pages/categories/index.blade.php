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
            كل التصنيفات
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
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
        <form action="{{ route('categories.index') }}" method="GET">
            <div class="mb-3">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <input class="form-control" value="{{ request('name') }}" name="name" type="text" placeholder="أسم التصنيف">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <input class="btn btn-success w-100" type="submit" value="بحث">
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>أسم التصنيف</th>
                  <th>وقت الأنشاء</th>
                  <th>وقت التعديل</th>
                  <th>الأعدادات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                        <td>


                            <div class="options d-flex">
                                <a class="btn btn-info ms-2"
                                    href="{{ route('categories.edit', $category) . '?page=' . request('page')  }}">
                                    <span>تعديل</span>
                                    <span class="mdi mdi-circle-edit-outline"></span>
                                </a>
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal_{{ $category->id }}">
                                    <span>ازالة</span>
                                    <span class="mdi mdi-delete-outline"></span>
                                </button>
                                <!-- Modal -->
                                @include('layouts.partials.modal', [
                                'id' => $category->id,
                                'route' => route('categories.destroy', $category->id)
                                ])
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            {{ $categories->links() }}
        </div>
      </div>
    </div>
    <!-- END Dynamic Table Full -->
  </div>
  <!-- END Page Content -->
@endsection
