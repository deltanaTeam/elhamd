@include('admin.layouts.head')
<!--begin::Body-->
<body id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

@include('admin.layouts.header-mobile')
<div class="d-flex flex-column flex-root">

    <div class="d-flex flex-row flex-column-fluid page">
         <!--begin::Aside-->
                 @include('admin.layouts.aside')
         <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

        @include('admin.layouts.topbar')

        <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container mt-16 mt-lg-0 mt-xl-0">
                        <!--begin::Dashboard-->

                        @yield('content')

                       <!--end::Dashboard-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
            @include('admin.layouts.footer-links')
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->


@include('admin.layouts.user-panel')
@include('admin.layouts.footer')
