{{-- resources/views/catalog.blade.php --}}
@extends('layouts.app')

@section('content')

	<div class="md:mx-60">
		<section id="feature">
        <h5 class="text-white feature_title text-center dark:text-white font-bold md:text-2xl sm:text-xl">
            Featured Luxury Cars
        </h5>
        <div class="flex justify-center items-center my-16">
            <a href="{{ home_url('/catalog') }}" class="feature_img bg-indigo-400 ml-4 mr-4 text-white p-4 rounded-2xl">All</a>

            @foreach ($car_brands as $brand)
                @php
                    $brand_image = get_field('car_image_brend', 'car_brand_' . $brand->term_id);
                    $isActive = request()->query('brand') == $brand->slug;
                @endphp
                <a href="{{ home_url('/catalog?brand=' . $brand->slug) }}" class="feature_img {{ $isActive ? 'bg-indigo-400' : 'bg-gray-800' }} hover:bg-gray-600 mr-4 {{ $isActive ? 'text-white' : 'text-zinc-400' }} p-4 rounded-2xl">
                    @if ($brand_image)
                        <img src="{{ $brand_image['url'] }}" class="w-5" alt="{{ $brand->name }}">
                    @else
                        {{ $brand->name }}
                    @endif
                </a>
            @endforeach
        </div>

        <div class="flex gap-2 mt-16 mb-5 justify-center">
            @if (!empty($cars))
                @foreach ($cars as $car)
                    <a href="{{ get_permalink($car->post_id) }}" class="w-1/3 feature_images bg-black hover:animate-pulse shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg mb-4 px-4">
                        <div class="p-4 flex flex-col justify-between h-full">
                            <div>
                                <p class="dark:text-white text-black font-bold text-xl mb-4">{{ $car->car_brand }}</p>
                                <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-4">{{ $car->car_model }} / {{ $car->year }}</p>
                                <img src="{{ $car->image }}" class="w-72 pl-5 duration-500 hover:-translate-y-5" alt="" /> <!-- Изменено на w-72 -->
                            </div>
                            <div class="mt-5 flex items-end justify-between h-10">
                                <p class="dark:text-zinc-400 text-zinc-200 font-bold pl-4">Год: {{ $car->year }}</p>
                            </div>
                        </div>
                    </a>
                    @if($loop->iteration % 3 == 0 && !$loop->last)
                        </div><div class="flex gap-2 mt-4 mb-5">
                    @endif
                @endforeach
            @else
                <p class="dark:text-white text-black font-bold text-xl">Автомобили не найдены.</p>
            @endif
        </div>


        @if (!empty($pagination))
            <div class="pagination flex justify-center text-white items-center mt-8 mb-28">
                {!! join(' ', $pagination) !!}
            </div>
        @endif

        {{-- <div class="pagination flex justify-center items-center mt-8">
            {{ paginate_links(array(
                'prev_text' => '« Предыдущая',
                'next_text' => 'Следующая »',
                'prev_next' => true,
                'ul_class' => 'flex list-none',
                'li_class' => 'mx-2',
                'current' => 'font-bold text-blue-500',
                'before_page_number' => '<span class="hover:text-blue-500">',
                'after_page_number' => '</span>',
            )) }}
        </div> --}}
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
	</div>


@endsection
