@extends('layouts.design')

@section('content')
  @include('components.header')
  <div class="main">
    <br>
    <div id="app">
        <pet-profile-component></pet-profile-component>
    </div>
  </div>
  @include('components.footer')

  @php
   $pictures = array();
   foreach ($pets as $key => $pet) {
     $pictures[$key] = Storage::disk('s3')->temporaryUrl($pet->pet_picture,now()->addMinutes(10));
   }
  @endphp

  <script>
      var pets = @json($pets);
      var pictures = @json($pictures);
  </script>

@endsection