@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            الأعدادات العامة
          </h1>
          <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            الأعدادات العامة
          </h2>
        </div>
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
          كل الأعدادات العامة
        </h3>
      </div>
      <div class="block-content">
          <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
              <div class="row">
                  <div class="col-12 col-md-6">
                      <div class="mb-3">
                          <label class="form-label" for="boolean-under_maintenance">تحت الصيانة</label>
                          <div>
                              <input class="form-check-input" type="checkbox" name="type[boolean-under_maintenance]"
                                  id="switch_under_maintenance" @if(get_setting('boolean-under_maintenance')) checked @endif/>
                          </div>
                      </div>
                  </div>
                  <div class="col-12 col-md-6">
                      <div class="mb-3">
                          <label class="form-label" for="name">أسم المشروع</label>
                          <input type="text" class="form-control" value="{{ get_setting('project_name') }}"
                              name="type[project_name]">
                          @error('project_name')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="col-12 col-md-6">
                      <div class="mb-3">
                          <label class="form-label" for="logo">اللوجو</label>
                          <input data-img="1" type="file" class="form-control input_files" accept="image/*" hidden name="logo">
                          <button type="button" class="btn btn-primary form-control files">
                              @if (!get_setting('logo'))
                                <i class="fa fa-plus" aria-hidden="true"></i>
                              @else
                                  {{ get_setting('logo') }}
                              @endif
                          </button>
                          <div class="imgs mt-2 d-flex">
                              @if (get_setting('logo'))
                                  <img src="{{ asset(get_setting('logo')) }}" alt="">
                              @else
                              <img src="{{ asset('/media/default.png') }}" alt="">
                              @endif
                          </div>
                      </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="name">البريد الألكترونى</label>
                        <input type="text" class="form-control" value="{{ get_setting('email') }}"
                            name="type[email]">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                  <div class="col-12 col-md-6">
                      <div class="mb-3">
                          <label class="form-label" for="name">الوصف</label>
                          <textarea id="textarea" class="form-control" name="type[description]"
                          rows="3">{{ get_setting('description') }}</textarea>
                          @error('description')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="col-12 col-md-6">
                      <div class="mb-3">
                          <label class="form-label" for="name">مفاتيح عمليات بحث جوجل</label>
                          <textarea id="textarea" class="form-control" name="type[keywords]"
                              rows="3">{{ get_setting('keywords') }}</textarea>
                              @error('keywords')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                      </div>
                  </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="name">المقال</label>
                            <textarea id="article" class="form-control" name="type[article]"
                                rows="3">{{ get_setting('article') }}</textarea>
                                @error('article')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="privacy">الخصوصية</label>
                            <textarea id="privacy" class="form-control" name="type[privacy]"
                                rows="3">{{ get_setting('privacy') }}</textarea>
                                @error('privacy')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                  <div class="col-12">
                      <div class="mb-3">
                          <label for=""></label>
                          <input type="submit" value="تعديل" class="btn btn-success">
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

CKEDITOR.replace( 'privacy', {
    language: 'ar',
    fontSize_defaultLabel: '20px'
} );
CKEDITOR.replace( 'article', {
    language: 'ar',
    fontSize_defaultLabel: '20px'
}  );
</script>
@endsection
