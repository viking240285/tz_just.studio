@extends('layouts.app')

@section('content')
    <section id="" class="mb-10 pt-28">
        <div class="image-bg flex justify-between gap-20 items-center relative" style="background-image: url('{{ asset('images/offer-bg.webp') }}');">
            <div id="about" class="w-1/2 relative about_left">
                <img src="{{ $car->image }}" class="rounded-lg shadow-sm" alt="">
            </div>
            <div class="w-1/2 about_right">
                <h5 class="text-white dark:text-white font-bold md:text-4xl sm:text-xl">
                    {{ $car->car_brand }} {{ $car->post_title }}
                </h5>
                <div class="text-gray-500 my-12">
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
                        @if (!empty($car->engine_type) && ($car->engine_type == 'Бензиновый' || $car->engine_type == 'Дизельный'))
                            <li><strong>Трансмиссия:</strong> {{ $car->transmission_type ?: '-' }}</li>
                        @endif
                        @if (!empty($car->engine_type) && $car->engine_type == 'Электрический')
                            <li><strong>Запас хода (км):</strong> {{ $car->range_km ?: '-' }}</li>
                        @endif
                        <li><strong>Год выпуска:</strong>
                            @if (!empty($car->year))
                                <a href="{{ home_url('/catalog?car_year=' . $car->year) }}" class="text-blue-500 hover:underline">{{ $car->year }}</a>
                            @else
                                {{ $car->year ?: '-' }}
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @include('partials.logo-cars')
@endsection
