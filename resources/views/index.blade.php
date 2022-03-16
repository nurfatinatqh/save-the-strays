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

@endsection