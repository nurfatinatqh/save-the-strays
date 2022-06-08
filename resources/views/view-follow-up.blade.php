@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
    <section class="module-view-follow-up" id="about">
        <div class="container" style="background-color: white; width: auto; padding:10px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center; color: steelblue; font-weight:700;">FOLLOW UP WITH THE CUTIES</h3>
                    <p style="text-align: center; color: coral; font-weight:600;">PREVENT PETS ABUSE AND NEGLECT CASES</p>

                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    
                    <table style="border: 1px dotted black; width: 100%">
                        <tr>
                            <th class="align-center" style="border: 1px dotted coral;"></th>
                            <th class="align-center" style="border: 1px dotted coral;">FOLLOW-UP 1</th>
                            <th class="align-center" style="border: 1px dotted coral;">FOLLOW-UP 2</th>
                            <th class="align-center" style="border: 1px dotted coral;">FOLLOW-UP 3</th>
                        </tr>
                        @foreach ($petAdopted as $pet)
                            @if ($pet->adoption_status == 1)
                                <tr style="vertical-align: top">
                                    <td style="border: 1px dotted coral; padding:20px; font-size:14px; color:black;">
                                        <div class="align-center">
                                            @php
                                            $url = Storage::disk('s3')->temporaryUrl(
                                                $pet->pet_picture,
                                                now()->addMinutes(10)
                                            );
                                            @endphp
                                            <img src="{{$url}}" style="height: 150px" alt=""><br><br>
                                            {{-- <img src="{{url($pet->pet_picture)}}" style="height: 150px" alt=""><br><br> --}}
                                        </div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th>NAME</th>
                                                <td>{{strtoupper($pet->name)}}</td>
                                            </tr>
                                            <tr>
                                                <th>RESCUER</th>
                                                <td>{{strtoupper($pet->volunteer->username)}}</td>
                                            </tr>
                                            <tr>
                                                <th>ADOPTER</th>
                                                <td>{{strtoupper($pet->adopter->username)}}</td>
                                            </tr>
                                            <tr>
                                                <th>ADOPTION DATE&nbsp;&nbsp</th>
                                                <td>{{Carbon\Carbon::parse($pet->adoption_date)->format('d/m/Y')}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    @php
                                        array_multisort(array_column($followUps, 'id'),  SORT_ASC,);
                                    @endphp
                                    @foreach ($followUps as $followUp)
                                        @if ($pet->id == $followUp->pet_id)
                                            <td style="border: 1px dotted coral; padding:20px; width:25%;">
                                                @if (Auth::user()->id == $followUp->adopter_id)
                                                    <div class="align-center">
                                                        @if (Carbon\Carbon::parse($followUp->follow_up_date)->format('F') != Carbon\Carbon::now()->format('F'))
                                                            <div style="color:cadetblue; font-weight:600;">FOLLOW-UP AVAILABLE ON {{strtoupper(Carbon\Carbon::parse($followUp->follow_up_date)->format('F'))}}</div>
                                                        @else
                                                            @if ($followUp->health_condition != null && $followUp->picture != null)
                                                                <div class="align-center">
                                                                    @php
                                                                    $url = Storage::disk('s3')->temporaryUrl(
                                                                        $followUp->picture,
                                                                        now()->addMinutes(10)
                                                                    );
                                                                    @endphp
                                                                    <img src="{{$url}}" style="height: 150px" alt=""><br><br>
                                                                    {{-- <img src="{{url($followUp->picture)}}" style="height: 150px" alt=""><br><br> --}}
                                                                </div>
                                                                <table style="width: 100%">
                                                                    <tr>
                                                                        <td>{{strtoupper($followUp->health_condition)}}</td>
                                                                    </tr>
                                                                </table>
                                                            @else
                                                                <a href="{{route('new.follow.up', $followUp->id)}}"><button class="btn btn-info btn-circle ">Submit</button></a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="align-center">
                                                        @if (Carbon\Carbon::parse($followUp->follow_up_date)->format('F') != Carbon\Carbon::now()->format('F'))
                                                            <div style="color:cadetblue; font-weight:600;">FOLLOW-UP AVAILABLE ON {{strtoupper(Carbon\Carbon::parse($followUp->follow_up_date)->format('F'))}}</div>
                                                        @else
                                                            @if ($followUp->health_condition != null && $followUp->picture != null)
                                                                <div class="align-center">
                                                                    @php
                                                                    $url = Storage::disk('s3')->temporaryUrl(
                                                                        $followUp->picture,
                                                                        now()->addMinutes(10)
                                                                    );
                                                                    @endphp
                                                                    <img src="{{$url}}" style="height: 150px" alt=""><br><br>
                                                                    {{-- <img src="{{url($followUp->picture)}}" style="height: 150px" alt=""><br><br> --}}
                                                                </div>
                                                                <table style="width: 100%">
                                                                    <tr>
                                                                        <td>{{strtoupper($followUp->health_condition)}}</td>
                                                                    </tr>
                                                                </table>
                                                            @else
                                                                NOT UPDATED YET
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endif
                                                
                                            </td>
                                        @endif
                                        
                                    @endforeach
                                </tr>
                            @endif
                            
                        @endforeach
                        
                    </table>
                    
                </div>
            </div>
        </div>
    @endsection

    
@endif