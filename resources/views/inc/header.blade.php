<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
      <!-- Left Section -->
      <div class="d-flex align-items-center">
        <!-- Toggle Sidebar -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
        <button type="button" class="btn btn-sm btn-alt-secondary ms-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
        </button>
        <!-- END Toggle Sidebar -->

        <!-- Toggle Mini Sidebar -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-alt-secondary ms-2 me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
            <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
        <!-- END Toggle Mini Sidebar -->
        <!-- Extra -->
            <div class="d-block">
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle" href="javascript:void(0)">
                <i class="far fa-moon"></i>
            </a>
            <!-- END Dark Mode -->

            <!-- Options -->
            <div class="dropdown d-inline-block ms-1">
                <a class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                <i class="far fa-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                <!-- Color Themes -->
                <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="default" href="#">
                    <span>Default</span>
                    <i class="fa fa-circle text-default"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/amethyst.css') }}" href="#">
                    <span>Amethyst</span>
                    <i class="fa fa-circle text-amethyst"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/city.css') }}" href="#">
                    <span>City</span>
                    <i class="fa fa-circle text-city"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/flat.css') }}" href="#">
                    <span>Flat</span>
                    <i class="fa fa-circle text-flat"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/modern.css') }}" href="#">
                    <span>Modern</span>
                    <i class="fa fa-circle text-modern"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/smooth.css') }}" href="#">
                    <span>Smooth</span>
                    <i class="fa fa-circle text-smooth"></i>
                </a>
                <!-- END Color Themes -->

                <div class="dropdown-divider"></div>

                <!-- Sidebar Styles -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light" href="javascript:void(0)">
                    <span>Sidebar Light</span>
                </a>
                <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark" href="javascript:void(0)">
                    <span>Sidebar Dark</span>
                </a>
                <!-- END Sidebar Styles -->

                <div class="dropdown-divider"></div>

                <!-- Header Styles -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light" href="javascript:void(0)">
                    <span>Header Light</span>
                </a>
                <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark" href="javascript:void(0)">
                    <span>Header Dark</span>
                </a>
                <!-- END Header Styles -->
                </div>
            </div>
            <!-- END Options -->

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            </div>
        <!-- END Extra -->

        <!-- Open Search Section (visible on smaller screens) -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        {{-- <button type="button" class="btn btn-sm btn-alt-secondary d-md-none" data-toggle="layout" data-action="header_search_on">
          <i class="fa fa-fw fa-search"></i>
        </button> --}}
        <!-- END Open Search Section -->


        <!-- Search Form (visible on larger screens) -->
        {{-- <form class="d-none d-md-inline-block" action="/dashboard" method="POST">
          @csrf
          <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
            <span class="input-group-text border-0">
              <i class="fa fa-fw fa-search"></i>
            </span>
          </div>
        </form> --}}
        <!-- END Search Form -->
      </div>
      <!-- END Left Section -->

      <!-- Right Section -->
      <div class="d-flex align-items-center">
        <!-- User Dropdown -->
        <div class="dropdown d-inline-block ms-2">
          <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 21px;">
            <span class="d-none d-sm-inline-block me-2 ms-2">{{ auth()->user()->email }}</span>
            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
            <div class="p-3 text-center bg-body-light border-bottom rounded-top">
              <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
              <p class="mt-2 mb-0 fw-medium">{{ auth()->user()->email }}</p>
              <p class="mb-0 text-muted fs-sm fw-medium">Web Developer</p>
            </div>
            <div class="p-2">
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('profile', auth()->user()) }}">
                <span class="fs-sm fw-medium">الملف الشخصى</span>
              </a>
            </div>
            <div role="separator" class="dropdown-divider m-0"></div>
            <div class="p-2">
              <form action="{{ route('logout') }}" method="POST" hidden>
                @csrf
                <button class="logout" hidden></button>
              </form>
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                <button class="btn btn-secondary" onclick="$('.logout').click()">تسجيل الخروج</button>
              </a>
            </div>
          </div>
        </div>
        <!-- END User Dropdown -->

        <!-- Notifications Dropdown -->
        {{-- <div class="dropdown d-inline-block ms-2">
          <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="text-primary">•</span>
          </button>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">
            <div class="p-2 bg-body-light border-bottom text-center rounded-top">
              <h5 class="dropdown-header text-uppercase">Notifications</h5>
            </div>
            <ul class="nav-items mb-0">
              <li>
                <a class="text-dark d-flex py-2" href="javascript:void(0)">
                  <div class="flex-shrink-0 me-2 ms-3">
                    <i class="fa fa-fw fa-check-circle text-success"></i>
                  </div>
                  <div class="flex-grow-1 pe-2">
                    <div class="fw-semibold">You have a new follower</div>
                    <span class="fw-medium text-muted">15 min ago</span>
                  </div>
                </a>
              </li>
              <li>
                <a class="text-dark d-flex py-2" href="javascript:void(0)">
                  <div class="flex-shrink-0 me-2 ms-3">
                    <i class="fa fa-fw fa-plus-circle text-primary"></i>
                  </div>
                  <div class="flex-grow-1 pe-2">
                    <div class="fw-semibold">1 new sale, keep it up</div>
                    <span class="fw-medium text-muted">22 min ago</span>
                  </div>
                </a>
              </li>
              <li>
                <a class="text-dark d-flex py-2" href="javascript:void(0)">
                  <div class="flex-shrink-0 me-2 ms-3">
                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                  </div>
                  <div class="flex-grow-1 pe-2">
                    <div class="fw-semibold">Update failed, restart server</div>
                    <span class="fw-medium text-muted">26 min ago</span>
                  </div>
                </a>
              </li>
              <li>
                <a class="text-dark d-flex py-2" href="javascript:void(0)">
                  <div class="flex-shrink-0 me-2 ms-3">
                    <i class="fa fa-fw fa-plus-circle text-primary"></i>
                  </div>
                  <div class="flex-grow-1 pe-2">
                    <div class="fw-semibold">2 new sales, keep it up</div>
                    <span class="fw-medium text-muted">33 min ago</span>
                  </div>
                </a>
              </li>
              <li>
                <a class="text-dark d-flex py-2" href="javascript:void(0)">
                  <div class="flex-shrink-0 me-2 ms-3">
                    <i class="fa fa-fw fa-user-plus text-success"></i>
                  </div>
                  <div class="flex-grow-1 pe-2">
                    <div class="fw-semibold">You have a new subscriber</div>
                    <span class="fw-medium text-muted">41 min ago</span>
                  </div>
                </a>
              </li>
              <li>
                <a class="text-dark d-flex py-2" href="javascript:void(0)">
                  <div class="flex-shrink-0 me-2 ms-3">
                    <i class="fa fa-fw fa-check-circle text-success"></i>
                  </div>
                  <div class="flex-grow-1 pe-2">
                    <div class="fw-semibold">You have a new follower</div>
                    <span class="fw-medium text-muted">42 min ago</span>
                  </div>
                </a>
              </li>
            </ul>
            <div class="p-2 border-top text-center">
              <a class="d-inline-block fw-medium" href="javascript:void(0)">
                <i class="fa fa-fw fa-arrow-down me-1 opacity-50"></i> Load More..
              </a>
            </div>
          </div>
        </div> --}}
        <!-- END Notifications Dropdown -->

        <!-- Toggle Side Overlay -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        {{-- <button type="button" class="btn btn-sm btn-alt-secondary ms-2" data-toggle="layout" data-action="side_overlay_toggle">
          <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
        </button> --}}
        <!-- END Toggle Side Overlay -->
      </div>
      <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
      <div class="content-header">
        <form class="w-100" action="/dashboard" method="POST">
          @csrf
          <div class="input-group">
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
              <i class="fa fa-fw fa-times-circle"></i>
            </button>
            <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
          </div>
        </form>
      </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-body-extra-light">
      <div class="content-header">
        <div class="w-100 text-center">
          <i class="fa fa-fw fa-circle-notch fa-spin"></i>
        </div>
      </div>
    </div>
    <!-- END Header Loader -->
  </header>
