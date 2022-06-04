@extends('layouts.design')

@section('content')
    <div class="">
        <section class="parent">
            <div class="container child">
                <h4 class="font-alt align-center">Reset Your Password With Worry Free!</h4>
                <br>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div id="app">
                        <reset-password-component></reset-password-component>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        var errors = @json($errors->all());
    </script>
@endsection