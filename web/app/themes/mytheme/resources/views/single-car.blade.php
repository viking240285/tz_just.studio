@extends('layouts.app')

@section('content')
<section id="" class="mb-10 pt-28">
    {{-- <div class="flex justify-between gap-20 items-center" id="about-section"> --}}
    {{-- <div class="image-bg flex justify-between gap-20 items-center " style="background-image: url('{{ asset('images/offer-bg.png') }}');"> --}}
    <div class="image-bg flex justify-between gap-20 items-center relative" style="background-image: url('{{ asset('images/offer-bg.webp') }}');">
            <!-- Добавляем псевдоэлемент для затемнения -->
        {{-- <div class="bg-black opacity-50 absolute inset-0"></div> --}}
        <div id="about" class="w-1/2 relative about_left">
            <img src="{{ $car->image }}" class="rounded-lg shadow-sm" alt="">
        </div>
        <div class="w-1/2 about_right">
            <h5 class="text-white dark:text-white font-bold md:text-4xl sm:text-xl">
                {{ $car->car_brand }} {{ $car->post_title }}
            </h5>
            <p class="text-gray-500 my-12">
                <ul class="list-none list-inside text-white">
                    <li><strong>Модель:</strong> {{ $car->post_title }}</li>
                    <li><strong>Бренд:</strong>
                        @if (!empty($car->car_brand))
                            <a href="{{ home_url('/catalog?brand=' . $car->car_brand) }}" class="text-blue-500 hover:underline">{{ $car->car_brand }}</a>
                        @else
                            {{ $car->car_brand ?: '-' }}
                        @endif
                    </li>
                    <li><strong>Тип двигателя:</strong> {{ $car->engine_type ?: '-' }}</li>
                    <li><strong>Трансмиссия:</strong> {{ $car->transmission_type ?: '-' }}</li>
                    <li><strong>Год выпуска:</strong>
                        @if (!empty($car->year))
                            <a href="{{ home_url('/catalog?year=' . $car->year) }}" class="text-blue-500 hover:underline">{{ $car->year }}</a>
                        @else
                            {{ $car->year ?: '-' }}
                        @endif
                    </li>
                    <li><strong>Запас хода (км):</strong> {{ $car->range_km ?: '-' }}</li>
                </ul>
            </p>
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
</section>
@endsection
