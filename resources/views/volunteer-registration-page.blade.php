@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-volunteer-registration" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">ARE YOU AN ADOPTER? </h3>
                    <p style="text-align: center; color: coral; font-weight:600;">JOIN US AND CHANGE YOUR ROLE TO VOLUNTEER</p>
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form action="{{route('register.as.volunteer', Auth::user()->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <br>
                        <div id="app">
                            <volunteer-registration-component></volunteer-registration-component>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-round" style="width: 100%">REGISTER NOW</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        var errors = @json($errors->all());
    </script>

    @endsection
    
@endif