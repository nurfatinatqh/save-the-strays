@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-edit-profile" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">START A NEW MEDICAL FUND</h3>
                    <p style="text-align: center; color: coral; font-weight:600;">A WAY TO HELP OUR LOVELY CUTIES</p>
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form action="{{route('submit.medical.fund', Auth::user())}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div id="app">
                            <new-medical-fund-component></new-medical-fund-component>
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