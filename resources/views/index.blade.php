@extends('layouts.design')

@section('content')
  @include('components.header')
  <div class="main">
    <br>
    @include('components.about-us')
    <br>
    @include('components.FAQ-and-mission')
  </div>
  @include('components.footer')

  <script>
    var coverage_list = @json($coverage_list);
    var state_count = @json($state_count);
  </script>

@endsection