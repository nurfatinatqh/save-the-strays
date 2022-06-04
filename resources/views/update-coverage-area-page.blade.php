@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-update-coverage-area" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">UPDATE COVERAGE AREA </h3>
                    <p style="text-align: center; color: coral; font-weight:600;">THIS PAGE IS INTENDED TO UPDATE THE COVERAGE AREA OF THE VOLUNTEER ACTIVITY</p>
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form action="{{route('submit.coverage.area', $coverageArea->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <br>
                        <div id="app">
                            <update-coverage-area-component></update-coverage-area-component>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-round" style="width: 100%">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        var errors = @json($errors->all());
        var coverageArea = @json($coverageArea);
    </script>

    @endsection
    
@endif