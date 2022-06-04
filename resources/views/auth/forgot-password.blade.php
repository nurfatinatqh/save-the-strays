@extends('layouts.design')

@section('content')
    <div class="">
        <section class="parent">
            <div class="container child">
                <h4 class="font-alt align-center">Forgot your password? No problem!</h4>
                <br>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div id="app">
                        <forgot-password-component></forgot-password-component>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        var errors = @json($errors->all());
    </script>
@endsection