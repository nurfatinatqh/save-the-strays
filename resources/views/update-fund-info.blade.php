@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-edit-profile" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">UPDATE MEDICAL FUND INFORMATION</h3>
                    <p style="text-align: center; color: coral; font-weight:600;">A WAY TO HELP OUR LOVELY CUTIES</p>
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form action="{{route('update.fund.info', $donation->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <br>
                        <div id="app">
                            <update-medical-fund-info-component></update-medical-fund-info-component>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-round" style="width: 100%">UPDATE INFO</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        var errors = @json($errors->all());
        var donation = @json($donation);
    </script>

    @endsection
    
@endif