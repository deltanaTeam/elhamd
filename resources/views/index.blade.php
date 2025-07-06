@extends('layouts.guest')

@section('title',  __('lang.home page'))

@section('content')

  <!-- Start Catrgories Slider -->
  <div class="bg-teal-700/95 dark:!bg-teal-700/80">
    <div class="wrapper">
      <!-- Start Categories List -->
      <div
        class=" hidden lg:!flex justify-between items-center gap-4 text-sm lg:text-sm xl:text-base xl:gap-6 2xl:gap-8 py-3 text-white dark:!text-gray-300"
      >
        <a href="" class="whitespace-nowrap">صحة الجهاز التنفسي</a>
        <a href="" class="whitespace-nowrap">رعاية العين والأذن</a>
        <a href="" class="whitespace-nowrap">صحة القلب</a>
        <a href="" class="whitespace-nowrap">رعاية الأطفال والرضع</a>
        <a href="" class="whitespace-nowrap">العناية بالبشرة</a>
        <a href="" class="whitespace-nowrap">الإسعافات الأولية</a>
        <a href="" class="whitespace-nowrap">صحة الجهاز الهضمي</a>
        <a href="" class="whitespace-nowrap">رعاية مرضى السكري</a>
        <a href="" class="whitespace-nowrap">تخفيف الألم</a>
      </div>
      <!-- End Categories List -->
    </div>
  </div>
  <!-- End Catrgories Slider -->

  <!-- Start Hero Section -->
  <section class="h-screen max-h-[800px] relative">
    <!-- Start Carousel Contianer -->
    <div class="w-full h-full absolute z-0">
      <!-- Start Hero Carousel -->
      <div id="heroCarousel" class="swiper w-full h-full">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img
              src="{{ asset('/images/banners/Hero.png') }}"
              alt=""
              class="object-cover h-full w-full"
            />
          </div>

          <div class="swiper-slide">
            <img
              src="{{ asset('images/banners/Hero.png') }}"
              alt=""
              class="object-cover h-full w-full"
            />
          </div>

          <div class="swiper-slide">
            <img
              src="{{ asset('images/banners/Hero.png') }}"
              alt=""
              class="object-cover h-full w-full"
            />
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <!-- End Hero Carousel -->
    </div>
    <!-- End Carousel Contianer -->

    <!-- Start Hero Contnet -->
    <div class="wrapper h-full pointer-events-none">
      <div
        class="flex flex-col text-gray-500 py-10 justify-center gap-6 h-full max-w-[640px]"
      >
        <h3 class="text-2xl font-medium">اهلا بك في صيدليتك</h3>
        <h1
          class="text-teal-600 text-4xl sm:text-5xl lg:text-7xl font-semibold lg:leading-20"
        >
          كل احتياجاتك الطبية في مكان واحد
        </h1>
        <div class="space-y-6">
          <h2 class="text-xl md:text-3xl leading-10">خصم يصل إلى 30٪</h2>
          <h4 class="md:text-xl font-medium">
            شحن مجاني على جميع طلباتك. نحن نوصل، وأنت تستمتع
          </h4>
        </div>
        <a
          href=""
          class="btn btn-primary-500 w-fit flex items-center gap-2 pointer-events-auto rounded-md"
        >
          <span class="text-lg leading-1 font-sans">اشتري الان</span>
          <span class="material-icons">arrow_forward</span>
        </a>
      </div>
    </div>
    <!-- End Hero Contnet -->
  </section>
  <!-- Start Hero Section -->

  <!-- Start Services and Features -->
  <section>
    <div class="wrapper">
      <div
        class="bg-base dark:bg-slate-800 dark:shadow-slate-600/30 !shadow-lg p-8 !rounded-md translate-y-[-20%] sm:translate-y-[-50%] grid sm:grid-cols-2 lg:grid-cols-4 gap-8"
      >
        <!-- Feature Card -->
        <div class="feature-card">
          <i data-lucide="headset" class="feature-icon"></i>
          <div class="flex flex-col">
            <p class="feature-title">دعم العملاء طوال أيام الأسبوع</p>
            <p class="feature-subtitle">الوصول الفوري إلى الدعم</p>
          </div>
        </div>
        <!-- Feature Card -->
        <div class="feature-card">
          <i data-lucide="truck-electric" class="feature-icon"></i>
          <div class="flex flex-col">
            <p class="feature-title">شحن مجاني</p>
            <p class="feature-subtitle">شحن مجاني على جميع طلباتك</p>
          </div>
        </div>
        <!-- Feature Card -->
        <div class="feature-card">
          <i data-lucide="shield-check" class="feature-icon"></i>
          <div class="flex flex-col">
            <p class="feature-title">دفع آمن 100%</p>
            <p class="feature-subtitle">نحن نضمن أن أموالك في أمان</p>
          </div>
        </div>
        <!-- Feature Card -->
        <div class="feature-card">
          <i data-lucide="package" class="feature-icon"></i>
          <div class="flex flex-col">
            <p class="feature-title">ضمان استرداد الأموال</p>
            <p class="feature-subtitle">
              ضمان استرداد الأموال لمدة 30 يومًا
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services and Features -->

  <!-- Start Offers Section -->
  <section class="pb-10 pt-4">
    <div class="wrapper">
      <!-- Swiper Container -->
      <div class="swiper-container">
        <!-- Start Offers Swiper Body -->
        <div class="swiper-body">
          <!-- Section Header -->
          <div class="swiper-header">
            <h3 class="swiper-title">العروض</h3>
            <a href="" class="external-link">
              <span>عرض الكل</span>
              <span class="material-icons">arrow_forward</span>
            </a>
          </div>

          <!-- Swiper Content -->
          <div class="relative">
            <div id="swiperOffers" class="swiper w-full overflow-hidden">
              <div class="swiper-wrapper">
                <template x-for="i in 10">
                  <div class="swiper-slide">
                    <div class="card-product">
                      <!-- Button add to Favorites -->
                      <button
                        x-data="{favorite:false}"
                        x-on:click="favorite = !favorite"
                        class="btn-favorite"
                      >
                        <!-- show if not added to favorites -->
                        <span
                          x-show="!favorite"
                          class="material-icons-outlined"
                          >favorite_border</span
                        >
                        <!-- show if added to favorites -->
                        <span
                          x-show="favorite"
                          class="material-icons-outlined"
                          >favorite</span
                        >
                      </button>

                      <!-- product image -->
                      <img
                        src="{{ asset('images/uploads/drug.jpg') }}"
                        alt=""
                        class="card-image"
                      />

                      <!-- products info -->
                      <div class="space-y-3 mt-5">
                        <!-- product Title -->
                        <h3 class="card-title">
                          فانيليا نوترين لمرض السكري
                        </h3>

                        <!-- products price and stats -->
                        <div
                          class="flex items-center gap-4 justify-between"
                        >
                          <!-- Price -->
                          <h4 class="card-price">1399$</h4>
                          <!-- Stats -->
                          <div class="flex items-end flex-col">
                            <!-- users rate -->
                            <div class="flex items-center gap-2">
                              <div
                                class="flex items-center text-yellow-500"
                              >
                                <template x-for="i in 4">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>

                            <!-- doctors rate -->
                            <div class="flex items-center gap-2">
                              <div class="flex items-center text-green-500">
                                <template x-for="i in 3">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="flex items-center justify-between gap-4"
                        >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >اشتري الآن</a
                          >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >مقارنة
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
            <div id="swiperOffersPrev" class="swiper-button-prev"></div>
            <div id="swiperOffersNext" class="swiper-button-next"></div>
          </div>
        </div>
        <!-- End Offers Swiper Body -->
      </div>
    </div>
  </section>
  <!-- End Offers Section -->

  <!-- Start Categories Section -->
  <section class="py-10">
    <div class="wrapper">
      <!-- Swiper Container -->
      <div class="swiper-container">
        <!-- Start Categories Swiper Body -->
        <div class="swiper-body">
          <!-- Section Title -->
          <h3 class="title">
            <span>تصفح جميع</span>
            <span class="text-teal-600">الفئات</span>
          </h3>

          <p class="sub-title">
            اختر من بين مجموعة واسعة من الأدوية، المنتجات الصحية، والعناية
            الشخصية – كل اللي تحتاجه في مكان واحد.
          </p>

          <!-- Swiper Content -->
          <div class="relative">
            <div
              id="swiperCategories"
              class="swiper swiper-products w-full overflow-hidden"
            >
              <div class="swiper-wrapper">
                <template x-for="i in 10">
                  <a href="" class="swiper-slide">
                    <div class="card-category">
                      <!-- category image -->
                      <img
                        src="{{ asset('images/uploads/category.jpg') }}"
                        alt=""
                        class="card-image"
                      />

                      <!-- category title -->
                      <div class="card-title">نيفيا</div>
                    </div>
                  </a>
                </template>
              </div>
            </div>
            <div id="swiperCategoriesPrev" class="swiper-button-prev"></div>
            <div id="swiperCategoriesNext" class="swiper-button-next"></div>
          </div>
        </div>
        <!-- End Categories Swiper Body -->
      </div>
    </div>
  </section>
  <!-- End Categories Section -->

  <!-- Start Best Section -->
  <section class="py-10">
    <div class="wrapper">
      <!-- Swiper Container -->
      <div class="swiper-container">
        <!-- Start Best Swiper Body -->
        <div class="swiper-body">
          <!-- Section Header -->
          <div class="swiper-header">
            <h3 class="swiper-title">المنتجات المتميزة</h3>
            <a href="" class="external-link">
              <span>عرض الكل</span>
              <span class="material-icons">arrow_forward</span>
            </a>
          </div>

          <!-- Swiper Content -->
          <div class="relative">
            <div
              id="swiperBest"
              class="swiper swiper-products w-full overflow-hidden"
            >
              <div class="swiper-wrapper">
                <template x-for="i in 10">
                  <div class="swiper-slide">
                    <div class="card-product">
                      <!-- Button add to Favorites -->
                      <button
                        x-data="{favorite:false}"
                        x-on:click="favorite = !favorite"
                        class="btn-favorite"
                      >
                        <!-- show if not added to favorites -->
                        <span
                          x-show="!favorite"
                          class="material-icons-outlined"
                          >favorite_border</span
                        >
                        <!-- show if added to favorites -->
                        <span
                          x-show="favorite"
                          class="material-icons-outlined"
                          >favorite</span
                        >
                      </button>

                      <!-- product image -->
                      <img
                        src="{{ asset('images/uploads/drug.jpg') }}"
                        alt=""
                        class="card-image"
                      />

                      <!-- products info -->
                      <div class="space-y-3 mt-5">
                        <!-- product Title -->
                        <h3 class="card-title">
                          فانيليا نوترين لمرض السكري
                        </h3>

                        <!-- products price and stats -->
                        <div
                          class="flex items-center gap-4 justify-between"
                        >
                          <!-- Price -->
                          <h4 class="card-price">1399$</h4>
                          <!-- Stats -->
                          <div class="flex items-end flex-col">
                            <!-- users rate -->
                            <div class="flex items-center gap-2">
                              <div
                                class="flex items-center text-yellow-500"
                              >
                                <template x-for="i in 4">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>

                            <!-- doctors rate -->
                            <div class="flex items-center gap-2">
                              <div class="flex items-center text-green-500">
                                <template x-for="i in 3">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="flex items-center justify-between gap-4"
                        >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >اشتري الآن</a
                          >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >مقارنة
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
            <div id="swiperBestPrev" class="swiper-button-prev"></div>
            <div id="swiperBestNext" class="swiper-button-next"></div>
          </div>
        </div>
        <!-- End Offers Swiper Body -->
      </div>
    </div>
  </section>
  <!-- End Best Section -->

  <!-- Start Brands Section -->
  <section class="py-10">
    <div class="wrapper">
      <!-- Swiper Container -->
      <div class="swiper-container">
        <!-- Start Brands Swiper Body -->
        <div class="swiper-body">
          <!-- Section Title -->
          <h3 class="title">
            <span>العلامات</span>
            <span class="text-teal-600">التجارية</span>
          </h3>

          <!-- Swiper Content -->
          <div class="relative">
            <div
              id="swiperBrands"
              class="swiper swiper-products w-full overflow-hidden"
            >
              <div class="swiper-wrapper">
                <template x-for="i in 10">
                  <a href="" class="swiper-slide">
                    <div class="card-category">
                      <!-- category image -->
                      <img
                        src="{{ asset('images/uploads/category.jpg') }}"
                        alt=""
                        class="card-image"
                      />

                      <!-- category title -->
                      <div class="card-title">نيفيا</div>
                    </div>
                  </a>
                </template>
              </div>
            </div>
            <div id="swiperBrandsPrev" class="swiper-button-prev"></div>
            <div id="swiperBrandsNext" class="swiper-button-next"></div>
          </div>
        </div>
        <!-- End Brands Swiper Body -->
      </div>
    </div>
  </section>
  <!-- End Brands Section -->

  <!-- Start Top products Section -->
  <section class="py-10">
    <div class="wrapper">
      <!-- Swiper Container -->
      <div class="swiper-container">
        <!-- Start Top Swiper Body -->
        <div class="swiper-body">
          <!-- Section Header -->
          <div class="swiper-header">
            <h3 class="swiper-title">المنتجات الأعلى تقييم</h3>
            <a href="" class="external-link">
              <span>عرض الكل</span>
              <span class="material-icons">arrow_forward</span>
            </a>
          </div>

          <!-- Swiper Content -->
          <div class="relative">
            <div
              id="swiperTop"
              class="swiper swiper-products w-full overflow-hidden"
            >
              <div class="swiper-wrapper">
                <template x-for="i in 10">
                  <div class="swiper-slide">
                    <div class="card-product">
                      <!-- Button add to Favorites -->
                      <button
                        x-data="{favorite:false}"
                        x-on:click="favorite = !favorite"
                        class="btn-favorite"
                      >
                        <!-- show if not added to favorites -->
                        <span
                          x-show="!favorite"
                          class="material-icons-outlined"
                          >favorite_border</span
                        >
                        <!-- show if added to favorites -->
                        <span
                          x-show="favorite"
                          class="material-icons-outlined"
                          >favorite</span
                        >
                      </button>

                      <!-- product image -->
                      <img
                        src="{{ asset('images/uploads/drug.jpg') }}"
                        alt=""
                        class="card-image"
                      />

                      <!-- products info -->
                      <div class="space-y-3 mt-5">
                        <!-- product Title -->
                        <h3 class="card-title">
                          فانيليا نوترين لمرض السكري
                        </h3>

                        <!-- products price and stats -->
                        <div
                          class="flex items-center gap-4 justify-between"
                        >
                          <!-- Price -->
                          <h4 class="card-price">1399$</h4>
                          <!-- Stats -->
                          <div class="flex items-end flex-col">
                            <!-- users rate -->
                            <div class="flex items-center gap-2">
                              <div
                                class="flex items-center text-yellow-500"
                              >
                                <template x-for="i in 4">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>

                            <!-- doctors rate -->
                            <div class="flex items-center gap-2">
                              <div class="flex items-center text-green-500">
                                <template x-for="i in 3">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="flex items-center justify-between gap-4"
                        >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >اشتري الآن</a
                          >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >مقارنة
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
            <div id="swiperTopPrev" class="swiper-button-prev"></div>
            <div id="swiperTopNext" class="swiper-button-next"></div>
          </div>
        </div>
        <!-- End Top Swiper Body -->
      </div>
    </div>
  </section>
  <!-- End Top products Section -->

  <!-- Start Banner Section -->
  <section class="!bg-purple-50 dark:bg-slate-800/80 relative">
    <!-- Banner Image -->
    <img
      src="{{ asset('images/uploads/drug-banner.png') }}"
      alt=""
      class="absolute top-0 object-cover object-center w-full h-full pointer-events-none"
    />
    <div class="wrapper">
      <div class="content-center py-8 min-h-80">
        <div
          class="flex flex-col items-center justify-center gap-6 text-center"
        >
          <h4 class="text-teal-700 text-xl font-medium">
            فيتامين ب6 (بيريدوكسين)
          </h4>

          <h2 class="text-teal-700 max-w-sm text-4xl font-semibold">
            الفيتامينات والمكملات الغذائية
          </h2>

          <a href="" class="btn btn-primary-500 rounded-md">
            <span>عرض المزيد</span>
            <span class="material-icons">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Section -->
  <!-- Start Top Brands Section -->
  <section class="py-10">
    <div class="wrapper">
      <!-- Swiper Container -->
      <div class="swiper-container">
        <!-- Start Top Brands Swiper Body -->
        <div class="swiper-body">
          <!-- Section Title -->
          <h3 class="title">
            <span>الماركات الأعل</span>
            <span class="text-teal-600">تقييم</span>
          </h3>

          <!-- Swiper Content -->
          <div class="relative">
            <div
              id="swiperTopBrands"
              class="swiper swiper-products w-full overflow-hidden"
            >
              <div class="swiper-wrapper">
                <template x-for="i in 10">
                  <a href="" class="swiper-slide">
                    <div class="card-category">
                      <!-- category image -->
                      <img
                        src="{{ asset('images/uploads/category.jpg') }}"
                        alt=""
                        class="card-image"
                      />

                      <!-- category title -->
                      <div class="card-title">نيفيا</div>
                    </div>
                  </a>
                </template>
              </div>
            </div>
            <div id="swiperTopBrandsPrev" class="swiper-button-prev"></div>
            <div id="swiperTopBrandsNext" class="swiper-button-next"></div>
          </div>
        </div>
        <!-- End Brands Swiper Body -->
      </div>
    </div>
  </section>
  <!-- End Top Brands Section -->

  <!-- Start Most Selling products Section -->
  <section class="py-10">
    <div class="wrapper">
      <!-- Swiper Container -->
      <div class="swiper-container">
        <!-- Start Most Selling Swiper Body -->
        <div class="swiper-body">
          <!-- Section Header -->
          <div class="swiper-header">
            <h3 class="swiper-title">المنتجات الأكثر مبيعا</h3>
            <a href="" class="external-link">
              <span>عرض الكل</span>
              <span class="material-icons">arrow_forward</span>
            </a>
          </div>

          <!-- Swiper Content -->
          <div class="relative">
            <div
              id="swiperMostSelling"
              class="swiper swiper-products w-full overflow-hidden"
            >
              <div class="swiper-wrapper">
                <template x-for="i in 10">
                  <div class="swiper-slide">
                    <div class="card-product">
                      <!-- Button add to Favorites -->
                      <button
                        x-data="{favorite:false}"
                        x-on:click="favorite = !favorite"
                        class="btn-favorite"
                      >
                        <!-- show if not added to favorites -->
                        <span
                          x-show="!favorite"
                          class="material-icons-outlined"
                          >favorite_border</span
                        >
                        <!-- show if added to favorites -->
                        <span
                          x-show="favorite"
                          class="material-icons-outlined"
                          >favorite</span
                        >
                      </button>

                      <!-- product image -->
                      <img
                        src="{{ asset('images/uploads/drug.jpg') }}"
                        alt=""
                        class="card-image"
                      />

                      <!-- products info -->
                      <div class="space-y-3 mt-5">
                        <!-- product Title -->
                        <h3 class="card-title">
                          فانيليا نوترين لمرض السكري
                        </h3>

                        <!-- products price and stats -->
                        <div
                          class="flex items-center gap-4 justify-between"
                        >
                          <!-- Price -->
                          <h4 class="card-price">1399$</h4>
                          <!-- Stats -->
                          <div class="flex items-end flex-col">
                            <!-- users rate -->
                            <div class="flex items-center gap-2">
                              <div
                                class="flex items-center text-yellow-500"
                              >
                                <template x-for="i in 4">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>

                            <!-- doctors rate -->
                            <div class="flex items-center gap-2">
                              <div class="flex items-center text-green-500">
                                <template x-for="i in 3">
                                  <span class="material-icons !text-lg"
                                    >star</span
                                  >
                                </template>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="flex items-center justify-between gap-4"
                        >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >اشتري الآن</a
                          >
                          <a
                            href=""
                            class="btn btn-primary-500 flex-1 rounded-md"
                            >مقارنة
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
            <div
              id="swiperMostSellingPrev"
              class="swiper-button-prev"
            ></div>
            <div
              id="swiperMostSellingNext"
              class="swiper-button-next"
            ></div>
          </div>
        </div>
        <!-- End Top Swiper Body -->
      </div>
    </div>
  </section>
  <!-- End Most Selling products Section -->

  <!-- Start Footer -->

  <!-- End Footer -->
@endsection
