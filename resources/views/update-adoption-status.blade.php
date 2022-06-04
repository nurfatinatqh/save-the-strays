@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-update-adoption-profile" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">UPDATE ADOPTION STATUS</h3>
                    <p style="text-align: center; color: coral; font-weight:600;">ONE MORE STEP TO BECOME THE PET OWNER</p>

                    <form action="{{route('update.adoption.status', $pet->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <table style="border: 1px solid; width: 100%">
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="adoption_date">ADOPTION DATE</label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="date" style="width: 100%" id="adoption_date" name="adoption_date" required></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="pet_picture">PROOF OF ADOPTION </label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="file" style="width: 100%" name="pet_picture" id="pet_picture" cols="30" rows="5" required></td>
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