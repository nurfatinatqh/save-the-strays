@extends('layouts.design')

@section('content')
  @include('components.header')

  <section class="module-tips" id="alt-features">
    <div class="container">
      <div class="row">
        <div class="">
          <h2 class="module-title font-alt">SHARE THE LOVE BY DONATING</h2>
          <p style="text-align: center; color: black; font-weight:400;">FOR THE SAKE OF SURVIVAL, MANY UNFORTUNATE ANIMALS ARE CLINGING TO THEIR TRAIL LITTLE LIVES. OFTEN, THE SURGERY OR THERAPY IS COSTLY, AND THE RECUSERS MUST BEAR THE COST. LET US LEND A HAND AND SHARE THE BURDEN WITH THEM SO THAT MORE LIVES CAN BE SAVED.<br><br>IF YOU RISH TO DO IT, YOU CAN DO IT BY MANUALLY TRANSFER THE MONEY THROUGH THE GIVEN BANK ACCOUNT, AND INFORM THE RECEIVER THROUGH EMAIL OR PHONE CALL. THE RECEIVER WILL UPDATE THE CASE UNTIL COMPLETED.</p>
        </div>
      </div>
      <br><br>
      <hr>
        <div class="row">
            <div class="col-sm-6" style="text-align: center"><b>CASE ANALYSIS</b></div>
            <div class="col-sm-6" style="text-align: center"><b>CASE INFORMATION</b></div>
        </div><hr>
        <div class="row">
            <div style="padding: 10px; height:350px; text-align:center;" class="col-sm-3">
                @php
                $url = Storage::disk('s3')->temporaryUrl(
                    $donation->pet_picture,
                    now()->addMinutes(10)
                );
                @endphp
                <img style="max-width: 100%; max-height:100%" src="{{$url}}" />
                {{-- <img width="auto" src="{{ url($donation->pet_picture) }}" /> --}}
            </div>
            <div style="padding: 10px; height:350px; text-align:center;" class="col-sm-3">
                @php
                $url = Storage::disk('s3')->temporaryUrl(
                    $donation->vet_analysis,
                    now()->addMinutes(10)
                );
                @endphp
                <img style="height: 350px" style="max-width: 100%; max-height:100%;  border: 1px solid beige;" src="{{$url}}" />
                {{-- <img style="height: auto" src="{{ url($donation->vet_analysis) }}" /> --}}
            </div>
            <div class="col-sm-6" style="padding: 15px;" >
                <div>
                    <table>
                        <tr>
                            <td>Pet Name</td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                            <td>{{$donation->pet_name}}</td>
                        </tr>
                        <tr>
                            <td>Health Condition</td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                            <td>{{$donation->health_condition}}</td>
                        </tr>
                        @if ($donation->phone_number != null)
                            <tr>
                                <td>Phone No</td>
                                <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                                <td>{{$donation->phone_number}}</td>
                            </tr>
                        @endif
                        @if ($donation->email != null)
                            <tr>
                                <td>Email</td>
                                <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                                <td>{{$donation->email}}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Bank</td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                            <td>{{$donation->bank}}</td>
                        </tr>
                        <tr>
                            <td>Bank No</td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                            <td>{{$donation->bank_no}}</td>
                        </tr>
                        <tr>
                            <td>Bank Reference</td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                            <td>{{$donation->bank_owner_name}}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%">Latest Amount</td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp; </td>
                            <td>RM{{$donation->current_amount}} / RM{{$donation->expected_amount}}</td>
                        </tr>
                    </table>
                    <br>
                    @if (Auth::check())
                        @if (Auth::user()->id == $donation->volunteer_id)
                            <table style="width: 100%; float: center;">
                                <tr>
                                    @if ($donation->status != "complete")
                                        <td>
                                            <form action="{{route('get.update.form', $donation->id)}}" method="get">
                                                <button style="float: right; width: 180px" type="submit" class="btn btn-success btn-round">UPDATE INFO</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <form action="{{route('get.update.case.form', $donation->id)}}" method="get">
                                                <button style="float: right; width: 180px" type="submit" class="btn btn-success btn-round">UPDATE CASE</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            </table>
                        @endif
                    @endif
                </div>
                <br>
            </div>
        </div><br><br>
      <div style="text-align: center"><hr><b>CASE OUTCOME</b><hr><br></div>
      <div class="row">
        <div class="col-sm-3"></div>
            <div style="padding: 10px; height:350px; text-align:right;" class="col-sm-3">
                @php
                $url = Storage::disk('s3')->temporaryUrl(
                    $donation->updated_condition,
                    now()->addMinutes(10)
                );
                @endphp
                <img style="max-width: 100%; max-height:100%" src="{{$url}}" />
                {{-- <img style="height: auto" src="{{ url($donation->updated_condition) }}" /> --}}
            </div>
            <div style="padding: 10px; height:350px; text-align:left;" class="col-sm-3">
                @php
                $url = Storage::disk('s3')->temporaryUrl(
                    $donation->receipt,
                    now()->addMinutes(10)
                );
                @endphp
                <img style="max-width: 100%; max-height:100%; border: 1px solid beige;" src="{{$url}}" />
                {{-- <img style="height: auto" src="{{ url($donation->receipt) }}" /> --}}
            </div>
            <div class="col-sm-3"></div>
      </div>
      <br><br>
      @if (count($donation->donors) == 0)
        <hr>
        <div class="align-center">No Donor Yet</div>
        <hr>
      @else
        <br><br>
        <form action="{{route('add.donor', $donation)}}" method="get">
            <button style="float: right; width: 180px" type="submit" class="btn btn-info btn-round">ADD DONOR</button>
        </form>
        <br><br>
        <table style="width: 100%">
            <tr style="border: 1px solid;  padding:10px; background-color:coral; color:white">
                <th>&nbsp;<br><br></th>
                <th> # </th>
                <th> NAME </th>
                <th> AMOUNT OF DONATION </th>
                <th> DATE </th>
            </tr>
            
            @foreach ($donation->donors as $key => $donor)
            <tr style="border: 1px solid #eee; padding:10px">
                <td>&nbsp;<br><br></td>
                <td> {{$key + 1}} </td>
                <td> {{$donor->name}} </td>
                <td> RM{{number_format((float)$donor->amount_of_donation, 2, '.', '')}}</td>
                <td> {{Carbon\Carbon::parse($donor->created_at)->format('d/m/Y')}} </td>
            </tr>
            @endforeach
            
        </table> 
      @endif
      
    </div>
  </section>
  
  @include('components.footer')

@endsection