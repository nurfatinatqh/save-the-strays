@extends('layouts.design')

@section('content')
    <div class="">
        <section class="parent">
            <div class="container child">
                <h4 class="font-alt align-center">Join us for more exciting experience!</h4>
                <br>
                <form method="POST" action="{{route('register')}}">
                    @csrf
                    <div id="app">
                        <register-component></register-component>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        var errors = @json($errors->all());
    </script>
@endsection