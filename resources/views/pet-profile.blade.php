@extends('layouts.design')

@section('content')
  @include('components.header')
  <script>
    if (!document.location.hash){
      document.location.hash = 'here';
    }
  </script>
  <div id="here" class="main">
    <br><br><br>
    <section class="module pet-profile pb-0" id="works">
      <div class="container">
      <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
          <h2 class="module-title font-alt">OWN YOURSELF A SWEET PET</h2>
          <div class="module-subtitle font-serif"></div>
          </div>
      </div>
      </div>
      <div class="container">
        <form action="{{route('pet.search')}}">
          <div id="app">
            <pet-profile-component></pet-profile-component>
          </div>
        </form>
      </div>
      <ul class="works-grid works-grid-gut works-grid-4 works-hover-w" id="works-grid">
        @foreach ($pets as $pet)
          <li class="work-item {{$pet->type}}">
            <div class="post">
                @php
                  $url = Storage::disk('s3')->temporaryUrl(
                    $pet->pet_picture,
                    now()->addMinutes(10)
                  );
                @endphp
                <div class="post-thumbnail align-center" style="height: 250px;"><img src="{{$url}}" style="max-width: 100%; max-height:100%; position:relative;" width="auto" alt="Blog-post Thumbnail"/></div>
                <div class="post-header font-alt">
                    <h2 class="post-title"> {{$pet->name}} <a href="{{route('update.adoption.status', $pet->id)}}"><button style="float: right; font-size:13px;" class="btn btn-warning btn-xs">UPDATE ADOPTION STATUS</button></a> </h2>
                    <div class="post-meta"><br>
                        BY {{$pet->volunteer['username']}} | {{$pet->phone_number}}&nbsp;<br>
                        {{$pet->city}}, {{$pet->state}} 
                    </div>
                </div>
                <div class="post-entry">
                <p style="font-size: small;">
                    Gender: {{$pet->gender}} <br>
                    Location: {{$pet->location}} <br>
                    Health Condition: {{$pet->health_condition}}
                </p>
                </div>
            </div>
          </li>
        @endforeach    
      </ul>
    </section>
    
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