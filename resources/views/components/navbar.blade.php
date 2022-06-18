<div class="collapse navbar-collapse" id="custom-collapse">
    <ul class="nav navbar-nav">
      @if ((Auth::check()))
        <li class="dropdown"><a class="dropdown-toggle" href="{{route('home')}}" data-toggle="dropdown">Home</a>
          <ul class="dropdown-menu">
            <li><a href="{{route('user.profile', Auth::user()->id)}}">My Profile</a></li>
          </ul>
        </li>
      @else
        <li><a href="{{route('home')}}">Home</a></li>
      @endif
      @if (Auth::check())
        @if (Auth::user()->role == "VOLUNTEER")
          <li class="dropdown"><a class="dropdown-toggle" href="{{route('pet.profile')}}" data-toggle="dropdown">Hello Pet</a>
            <ul class="dropdown-menu">
              <li><a href="{{route('create.pet.profile')}}">Create Pet Profile</a></li>
            </ul>
          </li>
        @else
          <li><a class="section-scroll" href="{{route('pet.profile')}}">Hello Pet</a></li>
        @endif
      @else
        <li><a class="section-scroll" href="{{route('pet.profile')}}">Hello Pet</a></li>
      @endif
      <li><a class="section-scroll" href="{{route('pet.tips')}}">Amazing Tips</a></li>
      @if (Auth::check())
        @if (Auth::user()->role == "VOLUNTEER")
          <li class="dropdown"><a class="dropdown-toggle" href="{{route('view.coverage.area')}}" data-toggle="dropdown">Volunteer</a>
            <ul class="dropdown-menu">
              <li><a href="{{route('update.coverage.area', Auth::user()->id)}}">Update Coverage Area</a></li>
            </ul>
          </li>
        @elseif (Auth::user()->role == "ADOPTER")
          <li class="dropdown"><a class="dropdown-toggle" href="{{route('view.coverage.area')}}" data-toggle="dropdown">Volunteer</a>
            <ul class="dropdown-menu">
              <li><a href="{{route('register.as.volunteer', Auth::user()->id)}}">Register as Volunteer</a></li>
            </ul>
          </li>
        @endif
      @else
        <li><a class="section-scroll" href="{{route('view.coverage.area')}}">Volunteer</a></li>
      @endif
      @if (Auth::check())
        @if (Auth::user()->role == "VOLUNTEER")
          <li class="dropdown"><a class="dropdown-toggle" href="{{route('all.medical.fund')}}" data-toggle="dropdown">Medical Fund</a>
            <ul class="dropdown-menu">
              <li><a href="{{route('start.medical.fund')}}">Start New Medical Fund</a></li>
              <li><a href="{{route('my.medical.fund', Auth::user()->id)}}">My Medical Fund</a></li>
            </ul>
          </li>
        @elseif (Auth::user()->role == "ADOPTER")
          <li><a class="section-scroll" href="{{route('all.medical.fund')}}">Medical Fund</a></li>
        @endif
      @else
        <li><a class="section-scroll" href="{{route('all.medical.fund')}}">Medical Fund</a></li>
      @endif
      @if (Auth::check())
        <li><a class="section-scroll" href="{{route('view.follow.up', Auth::user()->id)}}">Follow Up</a></li>
      @endif
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::check())
      <li>
        <a type="submit" class="section-scroll disable-select" onclick="
        document.getElementById('logout-form').submit();">
        LOGOUT</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
        </form>
      </li>
        
      @else
        <li><a class="section-scroll" href="{{ route('register') }}">Register</a></li>
        <li><a class="section-scroll" href="{{ route('login') }}">Login</a></li>
      @endif
    </ul>
  </div>