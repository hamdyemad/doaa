@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            لوحة التحكم
          </h1>
        </div>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <div class="row items-push">
      <div class="col-md-3">
        <div class="block block-rounded h-100 mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">عدد التصنيفات</h3>
          </div>
          <div class="block-content fs-sm text-muted">
              <h4>{{ $categoriesCount }}</h4>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="block block-rounded h-100 mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">عدد الأدعية</h3>
          </div>
          <div class="block-content fs-sm text-muted">
              <h4>{{ $prayersCount }}</h4>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="block block-rounded h-100 mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">عدد الصوتيات</h3>
          </div>
          <div class="block-content fs-sm text-muted">
              <h4>{{ $voicesCount }}</h4>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="block block-rounded h-100 mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">عدد الفديوهات</h3>
          </div>
          <div class="block-content fs-sm text-muted">
              <h4>{{ $vediosCount }}</h4>
          </div>
        </div>
      </div>


    </div>
  </div>
  <!-- END Page Content -->
@endsection
