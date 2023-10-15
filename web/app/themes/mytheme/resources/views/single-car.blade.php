{{-- resources/views/single-car.blade.php --}}
@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $car->post_title }}</h1>111

    <ul>
      <li><strong>Модель:</strong> {{ $car->post_title }}</li>
      <li><strong>Бренд:</strong> {{ $car->car_brand }}</li>
      <li><strong>Тип двигателя:</strong> {{ $car->engine_type ?: '-' }}</li>
      <li><strong>Трансмиссия:</strong> {{ $car->transmission_type ?: '-' }}</li>
      <li><strong>Год выпуска:</strong> {{ $car->year ?: '-' }}</li>
      <li><strong>Запас хода (км):</strong> {{ $car->range_km ?: '-' }}</li>
    </ul>
  </div>
@endsection
