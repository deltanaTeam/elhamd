<!-- @extends('layouts.guest') -->

@section('title',  __('lang.product page'))



   <main>
      <div class="wrapper">
        <!-- Start Products Contianer -->
        <div x-data="{showFilterMenu: false}" class="products-container">
          <!-- Start Filter -->
          <div x-bind:class="showFilterMenu && 'open'" class="products-filter">
            <div
              class="bg-base w-10/12 max-w-lg lg:w-full h-full overflow-auto"
            >
              <!-- Price Filter -->
              <div class="p-4 flex justify-end lg:hidden">
                <button @click="showFilterMenu = false" class="material-icons">
                  close
                </button>
              </div>
              <div class="collapse collapse-arrow">
                <input type="checkbox" checked name="my-accordion-2" che />
                <div class="collapse-title">السعر</div>
                <div class="collapse-content text-sm">
                  <div class="flex items-center gap-2">
                    <div class="input-group">
                      <label for="priceFrom">من</label>
                      <input type="text" class="" />
                    </div>
                    <div class="input-group">
                      <label for="priceFrom">إلى</label>
                      <input type="text" class="" />
                    </div>
                  </div>
                </div>
              </div>
              <!-- Doctor Rate Filter -->
              <div class="collapse collapse-arrow">
                <input type="checkbox" name="my-accordion-2" checked />
                <div class="collapse-title">تقييم الطبيب</div>
                <div class="collapse-content text-sm">
                  <div class="w-full max-w-xs">
                    <input
                      type="range"
                      min="0"
                      max="100"
                      value="25"
                      class="range range-xs"
                      step="25"
                    />

                    <div class="flex justify-between px-2.5 mt-2 text-xs">
                      <span>1</span>
                      <span>2</span>
                      <span>3</span>
                      <span>4</span>
                      <span>5</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Users Rate Filter -->
              <div class="collapse collapse-arrow">
                <input type="checkbox" name="my-accordion-2" checked />
                <div class="collapse-title">تقييم الزبائن</div>
                <div class="collapse-content text-sm">
                  <div class="w-full max-w-xs">
                    <input
                      type="range"
                      min="0"
                      max="100"
                      value="25"
                      class="range range-xs"
                      step="25"
                    />

                    <div class="flex justify-between px-2.5 mt-2 text-xs">
                      <span>1</span>
                      <span>2</span>
                      <span>3</span>
                      <span>4</span>
                      <span>5</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Start Cards List -->
          <div class="flex-grow-1">
            <div class="flex flex-col gap-3">
              <h3 class="flex items-center gap-2">
                <span>المنتجات المختارة:</span>
                <span class="text-teal-500">44</span>

                <button
                  class="btn py-1 btn-soft btn-accent flex items-center gap-1 ms-auto lg:hidden"
                  @click="showFilterMenu = !showFilterMenu"
                >
                  <span>تصفية</span>
                  <span class="material-icons">filter_list</span>
                </button>
              </h3>

              <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 lg:grid-cols-2 lg:gap-5 xl:grid-cols-3 justify-center xl:gap-6"
              >
                <div class="card-product">
                  <!-- Button add to Favorites -->
                  <button
                    x-data="{favorite:false}"
                    x-on:click="favorite = !favorite"
                    class="btn-favorite"
                  >
                    <!-- show if not added to favorites -->
                    <span x-show="!favorite" class="material-icons-outlined"
                      >favorite_border</span
                    >
                    <!-- show if added to favorites -->
                    <span x-show="favorite" class="material-icons-outlined"
                      >favorite</span
                    >
                  </button>

                  <!-- product image -->
                  <img
                    src="/images/uploads/drug.jpg"
                    alt=""
                    class="card-image"
                  />

                  <!-- products info -->
                  <div class="space-y-3 mt-5">
                    <!-- product Title -->
                    <h3 class="card-title">فانيليا نوترين لمرض السكري</h3>

                    <!-- products price and stats -->
                    <div class="flex items-center gap-4 justify-between">
                      <!-- Price -->
                      <h4 class="card-price">1399$</h4>
                      <!-- Stats -->
                      <div class="flex items-end flex-col">
                        <!-- users rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-yellow-500">
                            <template x-for="i in 4">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>

                        <!-- doctors rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-green-500">
                            <template x-for="i in 3">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-buttons">
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >اشتري الآن</a
                      >
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >مقارنة
                      </a>
                    </div>
                  </div>
                </div>

                <div class="card-product">
                  <!-- Button add to Favorites -->
                  <button
                    x-data="{favorite:false}"
                    x-on:click="favorite = !favorite"
                    class="btn-favorite"
                  >
                    <!-- show if not added to favorites -->
                    <span x-show="!favorite" class="material-icons-outlined"
                      >favorite_border</span
                    >
                    <!-- show if added to favorites -->
                    <span x-show="favorite" class="material-icons-outlined"
                      >favorite</span
                    >
                  </button>

                  <!-- product image -->
                  <img
                    src="/images/uploads/drug.jpg"
                    alt=""
                    class="card-image"
                  />

                  <!-- products info -->
                  <div class="space-y-3 mt-5">
                    <!-- product Title -->
                    <h3 class="card-title">فانيليا نوترين لمرض السكري</h3>

                    <!-- products price and stats -->
                    <div class="flex items-center gap-4 justify-between">
                      <!-- Price -->
                      <h4 class="card-price">1399$</h4>
                      <!-- Stats -->
                      <div class="flex items-end flex-col">
                        <!-- users rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-yellow-500">
                            <template x-for="i in 4">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>

                        <!-- doctors rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-green-500">
                            <template x-for="i in 3">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-buttons">
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >اشتري الآن</a
                      >
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >مقارنة
                      </a>
                    </div>
                  </div>
                </div>

                <div class="card-product">
                  <!-- Button add to Favorites -->
                  <button
                    x-data="{favorite:false}"
                    x-on:click="favorite = !favorite"
                    class="btn-favorite"
                  >
                    <!-- show if not added to favorites -->
                    <span x-show="!favorite" class="material-icons-outlined"
                      >favorite_border</span
                    >
                    <!-- show if added to favorites -->
                    <span x-show="favorite" class="material-icons-outlined"
                      >favorite</span
                    >
                  </button>

                  <!-- product image -->
                  <img
                    src="/images/uploads/drug.jpg"
                    alt=""
                    class="card-image"
                  />

                  <!-- products info -->
                  <div class="space-y-3 mt-5">
                    <!-- product Title -->
                    <h3 class="card-title">فانيليا نوترين لمرض السكري</h3>

                    <!-- products price and stats -->
                    <div class="flex items-center gap-4 justify-between">
                      <!-- Price -->
                      <h4 class="card-price">1399$</h4>
                      <!-- Stats -->
                      <div class="flex items-end flex-col">
                        <!-- users rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-yellow-500">
                            <template x-for="i in 4">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>

                        <!-- doctors rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-green-500">
                            <template x-for="i in 3">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-buttons">
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >اشتري الآن</a
                      >
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >مقارنة
                      </a>
                    </div>
                  </div>
                </div>

                <div class="card-product">
                  <!-- Button add to Favorites -->
                  <button
                    x-data="{favorite:false}"
                    x-on:click="favorite = !favorite"
                    class="btn-favorite"
                  >
                    <!-- show if not added to favorites -->
                    <span x-show="!favorite" class="material-icons-outlined"
                      >favorite_border</span
                    >
                    <!-- show if added to favorites -->
                    <span x-show="favorite" class="material-icons-outlined"
                      >favorite</span
                    >
                  </button>

                  <!-- product image -->
                  <img
                    src="/images/uploads/drug.jpg"
                    alt=""
                    class="card-image"
                  />

                  <!-- products info -->
                  <div class="space-y-3 mt-5">
                    <!-- product Title -->
                    <h3 class="card-title">فانيليا نوترين لمرض السكري</h3>

                    <!-- products price and stats -->
                    <div class="flex items-center gap-4 justify-between">
                      <!-- Price -->
                      <h4 class="card-price">1399$</h4>
                      <!-- Stats -->
                      <div class="flex items-end flex-col">
                        <!-- users rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-yellow-500">
                            <template x-for="i in 4">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>

                        <!-- doctors rate -->
                        <div class="flex items-center gap-2">
                          <div class="flex items-center text-green-500">
                            <template x-for="i in 3">
                              <span class="material-icons !text-lg">star</span>
                            </template>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-buttons">
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >اشتري الآن</a
                      >
                      <a href="" class="btn btn-primary-500 flex-1 rounded-md"
                        >مقارنة
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Start Pagination -->
        <div class="pagination">
          <div class="join">
            <button class="join-item btn">1</button>
            <button class="join-item btn active">2</button>
            <button class="join-item btn btn-disabled">...</button>
            <button class="join-item btn">99</button>
            <button class="join-item btn">100</button>
          </div>
        </div>
        <!-- Start Pagination -->
        <!-- End Products Container -->
      </div>
    </main>

  <script
      type="module"
      src="/src/js/productsList/ui-productsList.js"
    ></script>


