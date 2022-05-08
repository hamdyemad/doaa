<!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar" class="sidebar-r" aria-label="Main Navigation">
        <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
            <i class="fa fa-fw fa-times"></i>
        </a>
          <!-- END Close Sidebar -->
        <!-- Side Header -->
        <div class="content-header">
          <!-- Logo -->
          <div class="logo">
            <a href="{{ route('dashboard') }}">
                @if(get_setting('logo'))
                <img src="{{ asset(get_setting('logo')) }}" alt="">
                @else
                <img src="{{ asset('/media/default.png') }}" alt="">
                @endif
            </a>
            </div>
          <!-- END Logo -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
          <!-- Side Navigation -->
          <div class="content-side">

            <ul class="nav-main">
              <li class="nav-main-item">
                <a class="nav-main-link @if(activeRoute('dashboard')) active @endif" href="{{ route('dashboard') }}">
                  <i class="nav-main-link-icon si si-cursor"></i>
                  <span class="nav-main-link-name">لوحة التحكم</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link @if(activeRoute('settings.edit')) active @endif" href="{{ route('settings.edit') }}">
                  <i class="nav-main-link-icon fa fa-cog"></i>
                  <span class="nav-main-link-name">الأعدادات العامة</span>
                </a>
              </li>
              {{-- <li class="nav-main-heading">Various</li> --}}
              <li class="nav-main-item @if(activeRoute(['headers.create', 'headers.index'])) open @endif">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="{{ route('headers.index') }}">
                <i class="nav-main-link-icon fa fa-film" aria-hidden="true"></i>

                  <span class="nav-main-link-name">السلايدس</span>
                </a>
                <ul class="nav-main-submenu">
                  <li class="nav-main-item">
                    <a class="nav-main-link  @if(activeRoute('headers.index')) active @endif" href="{{ route('headers.index') }}">
                      <span class="nav-main-link-name">كل السلايدس</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link  @if(activeRoute('headers.create')) active @endif" href="{{ route('headers.create') }}">
                      <span class="nav-main-link-name">انشاء سلايد</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-main-item @if(activeRoute(['categories.create', 'categories.index'])) open @endif">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="{{ route('categories.index') }}">
                <i class="nav-main-link-icon fa fa-bars" aria-hidden="true"></i>
                  <span class="nav-main-link-name">التصنيفات</span>
                </a>
                <ul class="nav-main-submenu">
                  <li class="nav-main-item">
                    <a class="nav-main-link  @if(activeRoute('categories.index')) active @endif" href="{{ route('categories.index') }}">
                      <span class="nav-main-link-name">كل التصنيفات</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link  @if(activeRoute('categories.create')) active @endif" href="{{ route('categories.create') }}">
                      <span class="nav-main-link-name">انشاء تصنيف</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-main-item @if(activeRoute(['prayers.create', 'prayers.index'])) open @endif">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="{{ route('prayers.index') }}">
                  <i class="nav-main-link-icon si si-bulb"></i>
                  <span class="nav-main-link-name">الأدعية</span>
                </a>
                <ul class="nav-main-submenu">
                  <li class="nav-main-item">
                    <a class="nav-main-link  @if(activeRoute('prayers.index')) active @endif" href="{{ route('prayers.index') }}">
                      <span class="nav-main-link-name">كل الأدعية</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link  @if(activeRoute('prayers.create') && request('type') == '1')) active @endif" href="{{ route('prayers.create', ['type' => '1']) }}">
                      <span class="nav-main-link-name">انشاء دعاء مقالى</span>
                    </a>
                  </li>
                  <li class="nav-main-item">
                    <a class="nav-main-link  @if(activeRoute('prayers.create') && request('type') == '2')) active @endif" href="{{ route('prayers.create', ['type' => '2']) }}">
                      <span class="nav-main-link-name">انشاء دعاء مصور</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-main-item">
                <a class="nav-main-link @if(activeRoute('voices.index')) active @endif" href="{{ route('voices.index') }}">
                  <i class="nav-main-link-icon fas fa-volume-up"></i>
                  <span class="nav-main-link-name">الصوتيات </span>
                </a>
              </li>

              <li class="nav-main-item">
                <a class="nav-main-link @if(activeRoute('videos.index')) active @endif" href="{{ route('videos.index') }}">
                  <i class="nav-main-link-icon fas fa-video"></i>
                  <span class="nav-main-link-name">الفديوهات </span>
                </a>
              </li>

            </ul>
          </div>
          <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
      </nav>
