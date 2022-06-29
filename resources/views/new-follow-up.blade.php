@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-update-adoption-profile" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">SUBMIT FOLLOW-UP DETAILS</h3>
                    <p style="text-align: center; color: coral; font-weight:600;">THIS FORM IS INTENDED TO PROVIDE FOLLOW-UP DETAILS FOR RESCUER REFERENCE</p>

                    <form action="{{route('update.follow.up', $followUp->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <table style="border: 1px solid; width: 100%">
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="health_condition">HEALTH CONDITION</label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="text" style="width: 100%" id="health_condition" name="health_condition" required></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="picture">PICTURE </label></td>
                                <td style="border: 1px solid; padding: 10px;"><input accept="image/*" type="file" style="width: 100%" name="picture" id="picture" required></td>
                            </tr>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-success btn-round" style="width: 100%">UPDATE</button>
                    </form>
                    
                </div>
            </div>
        </div>
    @endsection

    
@endif