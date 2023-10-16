@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (! have_posts())
    <section id="feature">
        <h1 class="text-white feature_title text-center dark:text-white font-bold md:text-7xl sm:text-2xl">
            404
        </h1>
        <div class="flex gap-2 mt-16 mb-5 justify-center">
            <p class="dark:text-white text-black font-bold text-xl">
                <x-alert type="warning">
                    {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
                </x-alert>
            </p>
        </div>
    </section>
    {{-- {!! get_search_form(false) !!} --}}
  @endif
@endsection
