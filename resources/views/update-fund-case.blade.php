@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-update-adoption-profile" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">UPDATE CASE OUTCOME</h3>

                    <form action="{{route('update.fund.case', $donation->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <table style="border: 1px solid; width: 100%">
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="updated_condition">PET PICTURE </label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="file" style="width: 100%" name="updated_condition" id="updated_condition" required></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="receipt">RECEIPT </label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="file" style="width: 100%" name="receipt" id="receipt" required></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; padding: 10px;"><label for="health condition">HEALTH CONDITION </label></td>
                                <td style="border: 1px solid; padding: 10px;"><input type="text" style="width: 100%" name="health condition" id="health condition" required></td>
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