@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-edit-profile" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">CREATE A NEW PET PROFILE</h3>
                    <p style="text-align: center; color: coral; font-weight:600;">HELP TO FIND A LOVELY HOME FOR THE STRAYS</p>
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form action="{{route('store.pet.profile', Auth::user())}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div id="app">
                            <create-pet-profile-component></create-pet-profile-component>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-round" style="width: 100%">CREATE NOW</button>
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