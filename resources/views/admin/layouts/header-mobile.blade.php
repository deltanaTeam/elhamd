<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed mb-5">
    <!--begin::Logo-->
    <a href="{{route('admin.dashboard')}}">
        <img alt="Logo" src="{{asset('site/images/logo.png')}}" width="60px" height="40px" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">

          <span class="svg-icon svg-icon-xl">
            <svg width="24px" height="24px" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6L8 14L16 6V4H0V6Z" fill="#527a7a"/>
            </svg>

          </span>
        </button>

        <button class="btn p-0 burger-icon burger-icon-right" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->

        <!--begin::Topbar Mobile Toggle-->

        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
