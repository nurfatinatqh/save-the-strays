@extends('layouts.design')

@section('content')
    <div class="">
        <section class="parent">
            <div class="container child">
                <h4 class="font-alt align-center">Join us for more exciting experience!</h4>
                <br>
                <form autocomplete="off" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div id="app">
                        <login-component></login-component>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="form-group align-center"><a href="{{route('password.request')}}">Forgot Password?</a></div>
                    @endif
                </form>
            </div>
        </section>
    </div>

    <script>
        var errors = @json($errors->all());
    </script>
@endsection