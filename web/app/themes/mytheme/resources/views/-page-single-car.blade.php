@extends('layouts.app')

@section('content')


  <div class="md:mx-60">
      <!-- home start -->
      <section id="home" class="text-center flex flex-col justify-center items-center mt-16">
          <h5 class="text-dark dark:text-white font-bold md:text-4xl sm:text-xl home__title">Choose The Best Car</h5>
          <p class="text-dark dark:text-white font-semibold text-xl mt-3 home__subtitle">Porsche Mission E</p>
          <div class="flex mb-10 home__elec">
              <i class="ri-flashlight-fill text-indigo-400"></i>
              <p class="text-gray-300 md:text-base text-xl">Electic Car</p>
          </div>
          <img src="{{ asset('images/home.png') }}" class="w-60 home_img" alt="">

          <div class="flex justify-between w-96 mt-10">
              <div class="home__car-name">
                  <i class="ri-temp-cold-fill text-dark dark:text-white font-light text-xl"></i>
                  <p class="text-dark dark:text-white font-bold text-3xl mt-4 mb-1">24°</p>
                  <p class="text-neutral-300 text-[10px]">TEMPERATURE</p>
              </div>
              <div class="home__car-name">
                  <i class="ri-dashboard-3-line text-dark dark:text-white font-light text-xl"></i>
                  <p class="text-dark dark:text-white font-bold text-3xl mt-4 mb-1">873</p>
                  <p class="text-neutral-300 text-[10px]">MILEAGE</p>
              </div>
              <div class="home__car-name">
                  <i class="ri-flashlight-fill text-dark dark:text-white font-light text-xl"></i>
                  <p class="text-dark dark:text-white font-bold text-3xl mt-4 mb-1">94%</p>
                  <p class="text-neutral-300 text-[10px]">BATTERY</p>
              </div>
          </div>

          <div class="my-20 home_start_btn animate-bounce duration-300" id="start-btn">
              <a href="#about-section"
                  class="text-green-400 cursor-pointer active:w-16 active:h-16 shadow-md duration-300 hover:shadow-green-600 w-20 h-20 border border-2 rounded-full flex items-center justify-center border-green-500">
                  Start
              </a>
          </div>

      </section>
      <!-- home end -->

      <!-- about start -->
      <section id="" class="mb-10 pt-28">

          <div class="flex justify-between gap-20 items-center" id="about-section">
              <div id="about" class="w-1/2 relative about_left">
                  <img src="{{ asset('images/about.png') }}" class="rounded-lg shadow-sm" alt="">
                  <p
                      class="text-white px-2 text-center py-1 rounded-lg shadow c-bg-tran font-bold text-xl absolute bottom-1 right-1 ">
                      2.500+
                      <span class="text-gray-200 text-sm">
                          <br>
                          Supercharges placed <br> along popular routes
                      </span>
                  </p>
              </div>
              <div class="w-1/2 about_right">
                  <h5 class="text-dark dark:text-white font-bold md:text-4xl sm:text-xl">
                      Machines With <br> Future Technology
                  </h5>
                  <p class="text-gray-500 my-12">
                      See the future with high-performance electric cars produced by
                      renowned brands. They feature futuristic builds and designs with
                      new and innovative platforms that last a long time.
                  </p>
                  <button
                      class="text-white active:px-3 active:py-2 bg-indigo-400 rounded hover:bg-indigo-700 duration-300 px-5 py-4">
                      Know more
                  </button>
              </div>
          </div>

      </section>
      <!-- about end -->


      <!-- popular start -->

      <section id="popular" class="mt-24">
          <h5 class="popular_title text-dark text-center dark:text-white font-bold md:text-2xl sm:text-xl">
              Choose Your Electric Car <br> Of The Porsche Brand
          </h5>
          <div class="flex gap-4 mt-16 mb-28 swiper mySwiper">

              <div class="swiper-wrapper">
                  <div
                      class="swiper-slide w-1/3 bg-black hover:animate-pulse  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                      <div class="p-4">
                          <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                          <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                          <img src="{{ asset('images/popular1.png') }}" class="w-44 pl-5 duration-500 hover:-translate-y-5" alt="">
                          <div class="mt-4">
                              <div class="flex">
                                  <div class="w-1/2">
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2 pb-2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          3.7 Sec
                                      </p>
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          Electric

                                      </p>
                                  </div>
                                  <p class="dark:text-zinc-300 text-black text-xs w-1/2 pr-5">
                                      <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                      356 Km/h
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-5 flex justify-between h-10">
                          <p class="font-bold text-white text-xl pl-4">
                              $175,900
                          </p>
                          <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                              <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                          </button>
                      </div>
                  </div>
                  <div class="swiper-slide w-1/3 bg-black  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                      <div class="p-4">
                          <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                          <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                          <img src="{{ asset('images/popular2.png') }}" class="w-44 pl-5" alt="">
                          <div class="mt-4">
                              <div class="flex">
                                  <div class="w-1/2">
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2 pb-2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          3.7 Sec
                                      </p>
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          Electric

                                      </p>
                                  </div>
                                  <p class="dark:text-zinc-300 text-black text-xs w-1/2 pr-5">
                                      <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                      356 Km/h
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-5 flex justify-between h-10">
                          <p class="font-bold text-white text-xl pl-4">
                              $175,900
                          </p>
                          <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                              <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                          </button>
                      </div>
                  </div>
                  <div class="swiper-slide w-1/3 bg-black  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                      <div class="p-4">
                          <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                          <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                          <img src="{{ asset('images/popular3.png') }}" class="w-44 pl-5" alt="">
                          <div class="mt-4">
                              <div class="flex">
                                  <div class="w-1/2">
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2 pb-2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          3.7 Sec
                                      </p>
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          Electric

                                      </p>
                                  </div>
                                  <p class="dark:text-zinc-300 text-black text-xs w-1/2 pr-5">
                                      <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                      356 Km/h
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-5 flex justify-between h-10">
                          <p class="font-bold text-white text-xl pl-4">
                              $175,900
                          </p>
                          <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                              <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                          </button>
                      </div>
                  </div>
                  <div class="swiper-slide w-1/3 bg-black  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                      <div class="p-4">
                          <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                          <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                          <img src="{{ asset('images/popular4.png') }}" class="w-44 pl-5" alt="">
                          <div class="mt-4">
                              <div class="flex">
                                  <div class="w-1/2">
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2 pb-2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          3.7 Sec
                                      </p>
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          Electric

                                      </p>
                                  </div>
                                  <p class="dark:text-zinc-300 text-black text-xs w-1/2 pr-5">
                                      <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                      356 Km/h
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-5 flex justify-between h-10">
                          <p class="font-bold text-white text-xl pl-4">
                              $175,900
                          </p>
                          <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                              <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                          </button>
                      </div>
                  </div>
                  <div class="swiper-slide w-1/3 bg-black  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                      <div class="p-4">
                          <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                          <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                          <img src="{{ asset('images/popular5.png') }}" class="w-44 pl-5" alt="">
                          <div class="mt-4">
                              <div class="flex">
                                  <div class="w-1/2">
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2 pb-2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          3.7 Sec
                                      </p>
                                      <p class="dark:text-zinc-300 text-black text-xs w-1/2">
                                          <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                          Electric

                                      </p>
                                  </div>
                                  <p class="dark:text-zinc-300 text-black text-xs w-1/2 pr-5">
                                      <i class="ri-flashlight-fill text-dark dark:text-white font-light"></i>
                                      356 Km/h
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-5 flex justify-between h-10">
                          <p class="font-bold text-white text-xl pl-4">
                              $175,900
                          </p>
                          <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                              <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                          </button>
                      </div>
                  </div>
              </div>


          </div>
          <div class="">
              <h5 class="text-dark text-center more_feature_title dark:text-white font-bold md:text-2xl sm:text-xl">
                  More Features
              </h5>
              <div class="relative">
                  <img src="{{ asset('images/map.svg') }}" class="rotate-[-28deg]" alt="">
                  <img src="{{ asset('images/features.png') }}" class="absolute features_img top-16 w-48 left-80" alt="">
                  <div class="c-bg-tran2 w-32 feature_one rounded-3xl text-center py-2 absolute top-28 left-64">
                      <p class="text-white font-bold text-xl">800v</p>
                      <p class="text-gray-300">Turbo</p>
                      <p class="text-gray-300">Charge</p>
                  </div>
                  <div class="c-bg-tran2 feature_two w-32 rounded-3xl text-center py-2 absolute top-52 right-52">
                      <p class="text-white font-bold text-xl">800v</p>
                      <p class="text-gray-300">Turbo</p>
                      <p class="text-gray-300">Charge</p>
                  </div>
                  <div class="c-bg-tran2 w-32 feature_three rounded-3xl text-center py-2 absolute top-80 left-64">
                      <p class="text-white font-bold text-xl">800v</p>
                      <p class="text-gray-300">Turbo</p>
                      <p class="text-gray-300">Charge</p>
                  </div>
              </div>

          </div>
      </section>

      <!-- popular end -->


      <!-- feature start -->

      <section id="feature">
          <h5 class="text-dark feature_title text-center dark:text-white font-bold md:text-2xl sm:text-xl">
              Featured Luxury Cars
          </h5>
          <div class="flex justify-center items-center my-16">
              <button class="feature_img bg-indigo-400 ml-4 mr-4 text-white p-4 rounded-2xl">
                  All
              </button>
              <button class="feature_img active:bg-indigo-400 mr-4 bg-gray-800 text-zinc-400 active:text-white p-4 rounded-2xl">
                  <img src="{{ asset('images/logo1.png') }}" class="w-5" alt="">
              </button>
              <button class="feature_img active:bg-indigo-400 mr-4 bg-gray-800 text-zinc-400 active:text-white p-4 rounded-2xl">
                  <img src="{{ asset('images/logo4.png') }}" class="w-5" alt="">
              </button>
              <button class="feature_img active:bg-indigo-400 mr-4 bg-gray-800 text-zinc-400 active:text-white p-4 rounded-2xl">
                  <img src="{{ asset('images/logo3.png') }}" class="w-5" alt="">
              </button>
          </div>
          <div class="flex gap-4 mt-16 mb-24">
              <div
                  class="w-1/3 feature_images bg-black hover:animate-pulse  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                  <div class="p-4">
                      <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                      <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                      <img src="{{ asset('images/popular1.png') }}" class="w-44 pl-5 duration-500 hover:-translate-y-5"
                          alt="">

                  </div>
                  <div class="mt-5 flex justify-between h-10">
                      <p class="font-bold text-white text-xl pl-4">
                          $175,900
                      </p>
                      <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                          <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                      </button>
                  </div>
              </div>
              <div
                  class="w-1/3 feature_images bg-black hover:animate-pulse  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                  <div class="p-4">
                      <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                      <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                      <img src="{{ asset('images/popular2.png') }}" class="w-44 pl-5 duration-500 hover:-translate-y-5"
                          alt="">

                  </div>
                  <div class="mt-5 flex justify-between h-10">
                      <p class="font-bold text-white text-xl pl-4">
                          $175,900
                      </p>
                      <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                          <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                      </button>
                  </div>
              </div>
              <div
                  class="w-1/3 feature_images bg-black hover:animate-pulse  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                  <div class="p-4">
                      <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                      <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                      <img src="{{ asset('images/popular3.png') }}" class="w-44 pl-5 duration-500 hover:-translate-y-5"
                          alt="">

                  </div>
                  <div class="mt-5 flex justify-between h-10">
                      <p class="font-bold text-white text-xl pl-4">
                          $175,900
                      </p>
                      <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                          <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                      </button>
                  </div>
              </div>
          </div>
          <div class="flex gap-4 mb-28">
              <div
                  class="w-1/3 feature_images bg-black hover:animate-pulse  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                  <div class="p-4">
                      <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                      <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                      <img src="{{ asset('images/popular4.png') }}" class="w-44 pl-5 duration-500 hover:-translate-y-5"
                          alt="">

                  </div>
                  <div class="mt-5 flex justify-between h-10">
                      <p class="font-bold text-white text-xl pl-4">
                          $175,900
                      </p>
                      <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                          <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                      </button>
                  </div>
              </div>
              <div
                  class="w-1/3 feature_images bg-black hover:animate-pulse  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                  <div class="p-4">
                      <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                      <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                      <img src="{{ asset('images/popular5.png') }}" class="w-44 pl-5 duration-500 hover:-translate-y-5"
                          alt="">

                  </div>
                  <div class="mt-5 flex justify-between h-10">
                      <p class="font-bold text-white text-xl pl-4">
                          $175,900
                      </p>
                      <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                          <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                      </button>
                  </div>
              </div>
              <div
                  class="w-1/3 feature_images bg-black hover:animate-pulse  shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg">
                  <div class="p-4">
                      <p class="dark:text-white text-black font-bold text-xl">Porshe</p>
                      <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-7">Turbo 5</p>
                      <img src="{{ asset('images/popular1.png') }}" class="w-44 pl-5 duration-500 hover:-translate-y-5"
                          alt="">

                  </div>
                  <div class="mt-5 flex justify-between h-10">
                      <p class="font-bold text-white text-xl pl-4">
                          $175,900
                      </p>
                      {{-- <button class="bg-indigo-400 rounded-tl-lg rounded-br-lg hover:bg-indigo-700">
                          <i class="ri-sd-card-fill text-dark dark:text-white font-light px-4 py-5"></i>
                      </button> --}}
                  </div>
              </div>
          </div>
      </section>

      <!-- feature end -->
  </div>

  <!-- offer start -->
  <section class="w-full">
      <div class="image-bg flex" style="background-image: url('{{ asset('images/offer-bg.png') }}');">
          <div class="flex mx-60 justify-between items-center">
              <div class="w-1/2 offer_left pr-12">
                  <h5 class="text-dark dark:text-white font-bold md:text-3xl sm:text-xl">
                      Do You Want To Receive <br> Special Offers?
                  </h5>
                  <p class="text-gray-500 my-8">
                      Be the first to receive all the information about our
                      products and new cars by email by subscribing to our
                      mailing list.
                  </p>
                  <button
                      class="text-white active:px-3 active:py-2 bg-indigo-400 rounded hover:bg-indigo-700 duration-300 px-4 py-3">
                      Subscribe Now
                  </button>
              </div>
              <div class="w-1/2 offer_right">
                  <img src="{{ asset('images/offer.png') }}" class="" alt="">
              </div>
          </div>
      </div>
  </section>

  <section class="mx-60 my-20">
      <div class="flex justify-around w-full">
          <img src="{{ asset('images/logo1.png') }}"
              class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
          <img src="{{ asset('images/logo6.png') }}"
              class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
          <img src="{{ asset('images/logo3.png') }}"
              class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
          <img src="{{ asset('images/logo4.png') }}"
              class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
          <img src="{{ asset('images/logo5.png') }}"
              class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
      </div>
      <div class="flex my-20 gap-20">
          <div class="w-1/4 footer">
              <div class="text-dark dark:text-white columns-9 flex items-center mb-0">
                  <img src="{{ asset('images/favicon.png') }}" class="mr-2 bg-black rounded" alt="">
                  <p class="mb-0 text-dark dark:text-white md:text-xl text-2xl">Elecar</p>
              </div>
              <p class="dark:text-zinc-400 text-dark text-sm mt-5">
                  We offer the best electric cars of
                  the most recognized brands in
                  the world.
              </p>
          </div>
          <div class="w-1/4 footer">
              <div class="text-dark dark:text-white columns-9 flex items-center mb-0">
                  <p class="mb-0 text-dark dark:text-white md:text-xl text-2xl">Company</p>
              </div>
              <ul class="dark:text-zinc-400 list-none text-dark text-xs mt-5">
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">About</li>
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">Cars</li>
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">History</li>
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">Shop</li>
              </ul>

          </div>
          <div class="w-1/4 footer">
              <div class="text-dark dark:text-white columns-9 flex items-center mb-0">
                  <p class="mb-0 text-dark dark:text-white md:text-xl text-2xl">Information</p>
              </div>
              <ul class="dark:text-zinc-400 list-none text-dark text-xs mt-5">
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">Request a quote</li>
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">Find a dealer</li>
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">Contact us</li>
                  <li class="mb-2 cursor-pointer hover:text-white duration-300 text-sm">Services</li>
              </ul>

          </div>
          <div class="w-1/4 footer">
              <div class="text-dark dark:text-white columns-9 flex items-center mb-0">
                  <p class="mb-0 text-dark dark:text-white md:text-xl text-2xl">Follow us</p>
              </div>
              <div class="flex mt-5 justify-between">
                  <i class="ri-facebook-fill text-white hover:text-blue-700 duration-300 cursor-pointer text-2xl"></i>
                  <i class="ri-github-fill text-white hover:text-gray-500 duration-300 cursor-pointer text-2xl"></i>
                  <i
                      class="ri-instagram-fill text-white hover:text-pink-500 duration-300 cursor-pointer text-2xl"></i>

              </div>

          </div>

      </div>

  </section>




  <script src="{{ asset('scripts/custom/scrollreveal.min.js') }}"></script>
  <script src="{{ asset('scripts/custom/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('scripts/custom/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('scripts/custom/main.js') }}"></script>
@endsection
