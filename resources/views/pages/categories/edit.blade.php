@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            انشاء تصنيف
          </h1>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{ route('prayers.index') }}">الأدعية</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                انشاء تصنيف
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
            انشاء تصنيف
        </h3>
      </div>
      <div class="block-content">
        <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="page" value="{{ request('page') }}">
            @method("PATCH")
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" name="category">أسم التصنيف</label>
                        <input class="form-control" name="name" type="text" value="{{ $category->name }}">
                        @error('name')
                        <div class="alert-info p-2 mt-1 rounded">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for=""></label>
                        <input type="submit" value="تعديل" class="btn btn-info">
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
