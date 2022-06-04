@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-update-adoption-profile" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">ADD A NEW DONOR</h3>
                    <p style="text-align: center; color: coral; font-weight:600;">THIS FORM IS INTENDED TO ADD A NEW DONOR FOR VISITORS REFERENCE</p>
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form action="{{route('submit.donor', $donation)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <table style="border: 1px solid; width: 100%">
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="name">DONOR NAME </label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="text" style="width: 100%" id="name" name="name" required></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="amount_of_donation">AMOUNT OF DONATION </label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="number" step=".01" style="width: 100%" name="amount_of_donation" id="amount_of_donation" cols="30" rows="5" required></td>
                            </tr>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-success btn-round" style="width: 100%">SUBMIT</button>
                    </form>
                    
                </div>
            </div>
        </div>
    @endsection

    
@endif