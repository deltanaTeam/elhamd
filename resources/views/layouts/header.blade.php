

<header
  x-data="{showModalLogout: false}"
  class="fixed bg-base z-50 top-0 left-0 right-0 py-2 md:py-4 shadow-sm shadow-teal-700/20"
>
  <div class="wrapper">
    <div
      class="flex items-center justify-between gap-2 text-gray-500 dark:!text-gray-400"
    >
      <!-- App Logo -->
      <a href="/" class="">
        <img src="{{ asset('images/logos/Logo.svg')}}" alt="" class="w-10 lg:w-14" />
      </a>

      <!-- Start Nav Links -->
      <nav class=" hidden lg:!flex items-center gap-5 font-medium">
        <!-- Add the "text-teal-700" class to the active link -->
        <a href="{{route('home')}}"  class="{{request()->routeIs('home') ?'text-teal-700':''}}">{{__('lang.home')}}</a>
        <a href="{{route('about')}}" class="{{request()->routeIs('about') ?'text-teal-700':''}}">{{__('lang.about')}}</a>
        <a href="{{route('contact-us')}}" class="{{request()->routeIs('contact-us') ?'text-teal-700':''}}">{{__('lang.contact us')}}</a>
      </nav>
      <!-- End Nav Links -->

      <!-- Start Search Container -->
      <div
        class="flex max-w-md flex-grow-1 border border-teal-700 rounded-md bg-stone-200/50 dark:!bg-slate-200/10"
      >
        <div
          class="flex-grow-1 text-sm lg:text-md flex items-center px-2 sm:px-3 lg:px-5 lg:py-2 space-x-3"
        >
          <select
            name=""
            id=""
            class="hidden sm:!block text-gray-500 pe-2 dark:!text-gray-400"
          >
            <option value="-1" class="capitalize" selected>{{__('lang.all categories')}}</option>

          </select>
          <input
            type="text"
            class="flex-grow-1 text-gray-500 sm:ps-3 lg:!border-s-2 !border-stone-300 dark:!border-teal-800 dark:!text-gray-400 placeholder:text-sm placeholder:text-gray-500/70"
            placeholder=  "{{__('lang.search for medicines and medical products')}}"
          />
        </div>
        <span
          class="btn !h-9 aspect-square p-0 lg:p-3 btn-primary-500 border-0"
        >
          <i data-lucide="search"></i>
        </span>
      </div>
      <!-- End Search Container -->

      <!-- Start Utilities Shortcuts -->
      @php  $currentLocale = LaravelLocalization::getCurrentLocale();
      $otherLocale = $currentLocale ==='ar'?'en':'ar';
      @endphp
      <div class=" hidden lg:!flex items-center gap-4">
        <a x-on:click="changeDir()"  href="{{ LaravelLocalization::getLocalizedURL($otherLocale, null, [], true) }}">
          <i data-lucide="languages"></i>
        </a>
        <button
          x-on:click="changeTheme(); theme = theme==='light' ? 'dark' : 'light'"
          class=""
        >
          <i data-lucide="moon"></i>
        </button>
        <div class="flex items-center">
          <button
            popovertarget="cart-popover"
            style="anchor-name: --anchor-1"
          >
            <i data-lucide="shopping-cart"></i>
          </button>
          <div
            class="dropdown w-52 rounded-box card-base"
            popover
            id="cart-popover"
            style="position-anchor: --anchor-1"
          >
            <div class="card-body p-3">
              <span class="text-lg font-bold">8 {{__('lang.items')}}</span>
              <span class="text-teal-600">{{__('lang.total')}}: $999</span>
              <div class="card-actions">
                <a
                  href=""
                  class="btn !border btn-soft btn-info dark:btn-accent btn-block hover:!border-0 hover:!text-white"
                  >{{__('lang.view cart')}}</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Start Utilities Shortcuts -->

      <!-- Start Login Buttons, Profile Menu -->
      <div class="hidden lg:!block">
        <!-- User Menu and Avatar, visible only when user logged in -->
        <div class="">
          <!-- Profile Name and Avatar -->
          <button
            popovertarget="profile-popover"
            style="anchor-name: --anchor-profile"
            class="cursor-pointer flex items-center gap-4"
          >
            <div class="font-medium">
              <span>{{__('lang.welcome')}}</span>
              <span>{{__('lang.username')}}</span>
            </div>
            <div
              class="w-10 rounded-full btn-circle avatar overflow-hidden"
            >
              <img
                alt="Tailwind CSS Navbar component"
                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
              />
            </div>
          </button>
          <!-- Profile Menu -->
          <ul
            id="profile-popover"
            class="menu dropdown card-base !z-10 mt-3 w-52 !py-1 !px-1 text-base font-medium divide-y divide-stone-100 dark:divide-slate-800"
            popover
            style="position-anchor: --anchor-profile"
          >
            <li>
              <a
                class="justify-between py-3 active:!text-gray-600 hover:bg-stone-400/20 transition duration-200 active:!bg-stone-400/30"
              >
                <div class="flex items-center gap-2">
                  <span class="material-icons">person</span>
                  <span>{{__('lang.the account')}}</span>
                </div>
              </a>
            </li>
            <li>
              <a
                class="justify-between py-3 active:!text-gray-600 hover:bg-stone-400/20 transition duration-200 active:!bg-stone-400/30"
              >
                <div class="flex items-center gap-2">
                  <span class="material-icons">notifications</span>
                  <span>{{__('lang.notifications')}}</span>
                </div>
                <span class="badge badge-primary text-stone-200">+99</span>
              </a>
            </li>
            <li>
              <a
                class="justify-between py-3 active:!text-gray-600 hover:bg-stone-400/20 transition duration-200 active:!bg-stone-400/30"
              >
                <div class="flex items-center gap-2">
                  <span class="material-icons">bookmark</span>
                  <span>المحفوظات</span>
                </div>
              </a>
            </li>
            <li>
              <div
                onclick="modalLogout.showModal()"
                class="justify-between py-3 active:!text-gray-600 hover:bg-stone-400/20 transition duration-200 active:!bg-stone-400/30"
              >
                <div class="flex items-center gap-2">
                  <span class="material-icons text-red-600">logout</span>
                  <span>{{__('lang.logout')}}</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <!-- Signin button group, visible only if user not logged in -->
        <div class="hidden flex items-center gap-2">
          <a class="btn rounded-md btn-outline-primary-500"
            >{{__('lang.guest login')}}
          </a>
          <a class="btn rounded-md btn-primary-500">{{__('lang.login')}}</a>
        </div>
      </div>
      <!-- End Login Buttons, Profile Menu -->
      <!-- Start Mobile Menu -->
      <div x-data="{showMobileMenu:false}" class="lg:hidden">
        <button
          @click="showMobileMenu = !showMobileMenu"
          class="flex items-center"
        >
          <span class="material-icons">menu</span>
        </button>
        <div :class="showMobileMenu && 'open'" class="mobile-menu">
          <div
            class="flex relative pt-6 pb-2 px-4 h-full max-w-xl w-10/12 flex-col gap-3 bg-base overflow-y-auto"
          >
            <button
              @click="showMobileMenu = !showMobileMenu"
              class="cursor-pointer absolute top-3 !end-4 text-gray-400 dark:text-stone-300"
            >
              <span class="material-icons">close</span>
            </button>
            <a class="flex items-center gap-6">
              <img src="{{ asset('images/uploads/profile.png')}}" alt="" />
              <p class="font-medium">Hend Hussein</p>
            </a>

            <div
              class="flex-grow-1 flex flex-col divide-y divide-gray-200 dark:divide-slate-700"
            >
              <ul class="menu">
                <li>
                  <a
                    class="menu-item rounded-full"
                    href="/pages/account/auth/login"
                  >
                    <span class="material-icons"> login </span>

                    <p>{{__('lang.login')}}</p>
                  </a>
                </li>
              </ul>
              <!-- Categories List -->
              <div class="collapse collapse-arrow">
                <input type="checkbox" name="sideMenuAccordion" />
                <div class="collapse-title font-semibold">{{__('lang.catrgories')}}</div>
                <div class="collapse-content">
                  <ul class="menu">
    <li>
      <a class="menu-item rounded-full" href="/pages/profile/account">
        <p>jkhjhjhjhj</p>
      </a>
    </li>
    <li>
      <a class="menu-item rounded-full" href="#">
        <p>لا توجد تصنيفات</p>
      </a>
    </li>

                    <!-- <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/reservations"
                      >
                        <p>رعاية العين والأذن</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <p>صحة القلب</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <p>رعاية الأطفال والرضع</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <p>العناية بالبشرة</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <p>الإسعافات الأولية</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <p>صحة الجهاز الهضمي</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <p>رعاية مرضى السكري</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <p>تخفيف الألم</p>
                      </a>
                    </li> -->
                  </ul>
                </div>
              </div>

              <!-- Account Pages List -->
              <div class="collapse collapse-arrow">
                <input type="checkbox" name="sideMenuAccordion" />
                <div class="collapse-title font-semibold">الحساب</div>
                <div class="collapse-content">
                  <ul class="menu">
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/account"
                      >
                        <span class="material-icons"> account_circle </span>

                        <p>البيانات الشخصية</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/reservations"
                      >
                        <span class="material-icons"> room </span>

                        <p>العناوين</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <span class="material-icons">
                          replay_circle_filled
                        </span>

                        <p>المرتجعات</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <span class="material-icons"> credit_card </span>

                        <p>طرق الدفع</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <span class="material-icons">
                          account_balance_wallet
                        </span>

                        <p>المحفظة</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <span class="material-icons"> compare </span>

                        <p>مقارنة المنتجات</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <span class="material-icons"> favorite </span>

                        <p>المفضلة</p>
                      </a>
                    </li>
                    <li>
                      <a
                        class="menu-item rounded-full"
                        href="/pages/profile/favorites"
                      >
                        <span class="material-icons"> settings </span>

                        <p>الاعدادت</p>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>

              <!-- Social Media Links -->
              <ul class="menu">
                <li>
                  <a href="" class="menu-item rounded-full">
                    <img src="{{ asset('images/icons/social/facebook.svg')}}" alt="" />

                    <p>فيس بوك</p>
                  </a>
                </li>
                <li>
                  <a href="" class="menu-item rounded-full">
                    <img src="{{ asset('images/icons/social/instagram.svg')}}" alt="" />

                    <p>إنستغرام</p>
                  </a>
                </li>
                <li>
                  <a href="" class="menu-item rounded-full">
                    <img src="{{ asset('images/icons/social/twitter-x.svg')}}" alt="" />

                    <p>منصة إكس</p>
                  </a>
                </li>

                <li>
                  <a href="" class="menu-item rounded-full">
                    <img src="{{ asset('images/icons/social/linkedin.svg')}}" alt="" />

                    <p>لينكد إن</p>
                  </a>
                </li>
              </ul>

              <ul class="menu">
                <li>
                  <a href="" class="menu-item rounded-full">
                    <span class="material-icons"> mail </span>

                    <p>تواصل معنا</p>
                  </a>
                </li>
                <li>
                  <a href="" class="menu-item rounded-full">
                    <span class="material-icons"> info </span>

                    <p>من نحن</p>
                  </a>
                </li>
              </ul>

              <ul class="menu">
                <li @click="changeDir()">
                  <span class="menu-item rounded-full">
                    <span class="material-icons"> g_translate </span>

                    <p x-text="dir==='rtl'? 'enlish' :'عربي'"></p>
                  </span>
                </li>
                <li
                  @click="changeTheme(); theme = theme==='light' ? 'dark' : 'light'"
                >
                  <span
                    x-data="{dark: dir==='rtl'? 'الوضع الداكن' : 'Dark Mode', light: dir==='rtl'? 'الوضع الفاتح' : 'Light Mode'}"
                    class="menu-item rounded-full"
                  >
                    <span
                      x-text="theme==='dark'? 'light_mode' :'mode_night'"
                      class="material-icons"
                    >
                    </span>

                    <p x-text="theme==='dark'? light :dark"></p>
                  </span>
                </li>
              </ul>
              <ul class="menu !mt-auto">
                <li onclick="modalLogout.showModal()">
                  <button class="menu-item rounded-full">
                    <span class="material-icons !text-red-600">
                      logout
                    </span>

                    <p>تسجيل خروج</p>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- End Mobile Menu -->
    </div>
  </div>

  <!-- Start Mobile Nav -->
  <nav id="navMobile" class="nav-mobile">
    <div class="container mx-auto px-2">
      <div class="flex justify-around items-center h-16">
        <a class="nav-item active" href="/">
          <span class="material-icons">home</span>
          <span class="text-xs font-medium">الرئيسية</span>
        </a>
        <a class="nav-item" href="/pages/tabiba/tabiba">
          <span class="material-icons">medication_liquid</span>
          <span class="text-xs">جرعتي</span>
        </a>
        <a class="nav-item" href="/pages/center/center">
          <span class="material-icons">shopping_cart</span>
          <span class="text-xs">العربة</span>
        </a>

        <a class="nav-item" href="/pages/blog/blogs-category">
          <span class="material-icons">delivery_dining</span>
          <span class="text-xs">طلباتي</span>
        </a>
        <a class="nav-item" href="/pages/forum/forum">
          <span class="material-icons">forum</span>
          <span class="text-xs">المحادثات</span>
        </a>
      </div>
    </div>
  </nav>
  <!-- End Mobile Nav -->

  <!-- Start Modal Logout -->
  <dialog id="modalLogout" :class="showModalLogout && 'show'" class="modal">
    <div class="modal-box card-base shadow-md flex flex-col gap-4">
      <form method="dialog">
        <button class="block ms-auto">
          <span class="material-icons">close</span>
        </button>
      </form>
      <h3 class="text-xl font-medium">هل تريد تسجيل الخروج؟</h3>
      <form method="dialog" class="flex items-center gap-5">
        <button class="btn btn-primary-500">نعم</button>
        <button
          @click="showModalLogout = !showModalLogout"
          class="btn btn-outline-primary-500"
        >
          لا
        </button>
      </form>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
  <!-- End Modal Logout -->
</header>
