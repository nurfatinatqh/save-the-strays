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
      <div role="tabpanel">
        <ul class="nav nav-tabs font-alt" role="tablist">
          <li class="active"><a href="#ongoing" data-toggle="tab"><span class="icon-tools-2"></span> ON GOING</a></li>
          <li><a href="#complete" data-toggle="tab"><span class="icon-heart"></span> COMPLETE</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="ongoing">
            @foreach ($ongoing_list as $ongoing_donation)
              <div class="row">
                  <div style="padding: 10px;" class="col-sm-4">
                      @php
                        $url = Storage::disk('s3')->temporaryUrl(
                          $ongoing_donation->pet_picture,
                          now()->addMinutes(10)
                        );
                      @endphp
                      {{-- <img width="auto" src="{{ url($ongoing_donation->pet_picture) }}" /> --}}
                      <img width="auto" src="{{$url}}" />
                  </div>
                  <div style="padding: 10px;" class="col-sm-2">
                      @php
                        $url = Storage::disk('s3')->temporaryUrl(
                          $ongoing_donation->vet_analysis,
                          now()->addMinutes(10)
                        );
                      @endphp
                      <img style="height: auto" src="{{$url}}" />
                      {{-- <img style="height: auto" src="{{ url($ongoing_donation->vet_analysis) }}" /> --}}
                  </div>
                  <div style="padding: 15px;" class="col-sm-6">
                      <table>
                          <tr>
                              <td>Pet Name: </td>
                              <td>{{$ongoing_donation->pet_name}}</td>
                          </tr>
                          <tr>
                              <td>Health Condition: </td>
                              <td>{{$ongoing_donation->health_condition}}</td>
                          </tr>
                          <tr>
                              <td>Phone No: </td>
                              <td>{{$ongoing_donation->phone_number}}</td>
                          </tr>
                          <tr>
                              <td>Email: </td>
                              <td>{{$ongoing_donation->email}}</td>
                          </tr>
                          <tr>
                              <td>Bank: </td>
                              <td>{{$ongoing_donation->bank}}</td>
                          </tr>
                          <tr>
                              <td>Bank No: </td>
                              <td>{{$ongoing_donation->bank_no}}</td>
                          </tr>
                          <tr>
                              <td>Bank Reference: </td>
                              <td>{{$ongoing_donation->bank_owner_name}}</td>
                          </tr>
                          <tr>
                              <td style="width: 30%">Latest Amount: </td>
                              <td>RM{{$ongoing_donation->current_amount}} / RM{{$ongoing_donation->expected_amount}}</td>
                          </tr>
                      </table>
                      <br>
                      <form action="{{route('view.donors', $ongoing_donation)}}" method="get">
                          <button style="float: right; width: 180px" type="submit" class="btn btn-success btn-round">VIEW DONORS</button>
                      </form>
                      
                      
                  </div>
              </div>
              <hr>
            @endforeach
          </div>
          <div class="tab-pane" id="complete">
            @foreach ($complete_list as $complete_donation)
              <div class="row">
                  <div style="padding: 10px;" class="col-sm-4">
                      @php
                        $url = Storage::disk('s3')->temporaryUrl(
                          $complete_donation->pet_picture,
                          now()->addMinutes(10)
                        );
                      @endphp
                      {{-- <img width="auto" src="{{ url($complete_donation->pet_picture) }}" /> --}}
                      <img width="auto" src="{{$url}}" />
                  </div>
                  <div style="padding: 10px;" class="col-sm-2">
                      @php
                        $url = Storage::disk('s3')->temporaryUrl(
                          $complete_donation->vet_analysis,
                          now()->addMinutes(10)
                        );
                      @endphp
                      <img style="height: auto" src="{{$url}}" />
                      {{-- <img style="height: auto" src="{{ url($complete_donation->vet_analysis) }}" /> --}}
                  </div>
                  <div style="padding: 15px;" class="col-sm-6">
                      <table>
                          <tr>
                              <td>Pet Name: </td>
                              <td>{{$complete_donation->pet_name}}</td>
                          </tr>
                          <tr>
                              <td>Health Condition: </td>
                              <td>{{$complete_donation->health_condition}}</td>
                          </tr>
                          <tr>
                              <td>Phone No: </td>
                              <td>{{$complete_donation->phone_number}}</td>
                          </tr>
                          <tr>
                              <td>Email: </td>
                              <td>{{$complete_donation->email}}</td>
                          </tr>
                          <tr>
                              <td style="width: 30%">Latest Amount: </td>
                              <td>RM{{$complete_donation->current_amount}} / RM{{$complete_donation->expected_amount}}</td>
                          </tr>
                      </table>
                      <br>
                      <form action="{{route('view.donors', $complete_donation)}}" method="get">
                          <button style="float: right; width: 180px" type="submit" class="btn btn-success btn-round">VIEW DONORS</button>
                      </form>
                      
                      
                  </div>
              </div>
              <hr>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  
  @include('components.footer')

@endsection