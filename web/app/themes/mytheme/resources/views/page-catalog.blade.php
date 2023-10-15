{{-- resources/views/catalog.blade.php --}}
@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Каталог автомобилей</h1>

    <div class="car-catalog">
        @if (!empty($cars))
            <ul>
                @foreach ($cars as $car)
                    <li>
                        <h3>{{ $car->car_brand }} - {{ $car->car_model }}</h3>
                        <p>Year: {{ $car->year }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No cars found.</p>
        @endif

        @if (!empty($pagination))
            <div class="pagination">
                {!! join(' ', $pagination) !!}
            </div>
        @endif
    </div>

    {{-- Здесь можно добавить форму для фильтрации по бренду и году выпуска --}}

    {{-- <ul>
      @foreach ($cars as $car)
        <li>
          <a href="{{ route('car.single', $car->post_name) }}">{{ $car->post_title }}</a>
        </li>
      @endforeach
    </ul> --}}
    {{-- @foreach($cars as $car)
      <div class="car">
          <h2>{{ $car->car_brand }} - {{ $car->car_model }}</h2>
          <p>Year: {{ $car->year }}</p>
          <!-- Остальные свойства автомобиля -->
      </div>
  @endforeach --}}

    {{-- Постраничная навигация --}}
    {{-- {{ $cars->links() }} --}}
    {{-- {{ $carCatalogComposer->with()['cars']->links() }} --}}
    {{-- <div class="pagination">
      {{ App\pagination() }}
    </div> --}}
    {{-- <div class="pagination">
      {{ paginate_links() }}
    </div> --}}
    <div class="pagination">
      {{ paginate_links(array('prev_text' => '« Предыдущая', 'next_text' => 'Следующая »')) }}
    </div>

  </div>
@endsection
