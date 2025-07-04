<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between"
         >
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar " >




            <!--begin::User-->
            <div class="topbar-item " >
                <div
                    class="btn btn-icon  w-auto btn-clean d-flex align-items-center btn-lg px-2"
                    >
                     <span  class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"> @guest username  @endguest @auth <a class="btn " href="{{route('admin.profile.edit')}}">{{auth()->user()->name}}</a> @endauth</span>
                </div>
            </div>


            <!--end::User-->
        </div>
        <div class="topbar " >
          <!--begin::Languages-->

            <div class="dropdown">
                <!--begin::Toggle-->

                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <i class="fa fa-flag"></i>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div
                    class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">

                      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                       <li class="navi-item">
                        <a rel="alternate" class="navi-link"  hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                          <span class="navi-text">  {{ $properties['native'] }} </span>

                        </a>
                    </li>
                      @endforeach
                       <!--end::Item-->
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Languages-->
          <div class="topbar-item " >
          @yield('sub-topbar')

          </div>
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
