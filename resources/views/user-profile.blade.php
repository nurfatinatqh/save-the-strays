@if (Auth::check())
    @extends('layouts.design')

    @section('content')
    <br><br>
        @if ($option == 'update')
        <section class="module-edit-profile" id="about">
            <div class="container" style="background-color: white; width: auto; padding:10px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="widget-posts-image">
                                    @if ($user->image != null)
                                        @php
                                        $url = Storage::disk('s3')->temporaryUrl(
                                            $user->image,
                                            now()->addMinutes(10)
                                        );
                                        @endphp
                                        <img src="{{$url}}" alt="Post Thumbnail"/>
                                        {{-- <img src="{{ url($user->image) }}" alt="Post Thumbnail"/> --}}
                                    @else
                                        <img src="{{asset('assets/images/profile.jpg')}}" alt="Post Thumbnail"/>
                                    @endif
                                </div>
                                <div class="widget-posts-body">
                                  <div class="widget-posts-title"><h3>&nbsp;&nbsp;&nbsp;&nbsp;MY PROFILE</h3></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('user.profile', Auth::user())}}" method="get">
                                    <button style="float: right;" type="submit" class="btn btn-info btn-round">BACK</button>
                                </form>
                            </div>
                        </div>
                        <form action="{{route('user.profile.update', Auth::user())}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <br>
                            <div id="app">
                                <edit-profile-component></edit-profile-component>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success btn-round" style="width: 100%">UPDATE PROFILE</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @elseif ($option == 'view')
            <section class="module-profile" id="about">
                <div class="container" style="background-color: white; width: auto; padding:10px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="widget-posts-image">
                                        @if ($user->image != null)
                                            @php
                                            $url = Storage::disk('s3')->temporaryUrl(
                                                $user->image,
                                                now()->addMinutes(10)
                                            );
                                            @endphp
                                            <img src="{{$url}}" alt="Post Thumbnail"/>
                                            {{-- <img src="{{ url($user->image) }}" alt="Post Thumbnail"/> --}}
                                        @else
                                            <img src="{{asset('assets/images/profile.jpg')}}" alt="Post Thumbnail"/>
                                        @endif
                                    </div>
                                    <div class="widget-posts-body">
                                      <div class="widget-posts-title"><h3>&nbsp;&nbsp;&nbsp;&nbsp;MY PROFILE</h3></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <form action="{{route('user.profile.update', Auth::user())}}" method="get">
                                        <button style="float: right;" type="submit" class="btn btn-success btn-round">UPDATE PROFILE</button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <table style="border: 1px solid; width: 100%">
                                <tr>
                                    <td style="border: 1px solid; padding: 10px;"><label for="username">USERNAME </label></td>
                                    <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" type="text" id="username" name="username" value="{{$user->username}}" disabled></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid; padding: 10px;"><label for="email">EMAIL &nbsp;&nbsp;</label></td>
                                    <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" type="email" id="email" name="email" value="{{$user->email}}" disabled></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid; padding: 10px;"><label for="phone_number">PHONE NUMBER </label></td>
                                    <td style="border: 1px solid; padding: 10px;"><input style="width: 100%" type="text" id="phone_number" name="phone_number" value="{{$user->phone_number}}" disabled></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid; padding: 10px;"><label for="address">ADDRESS </label></td>
                                    <td style="border: 1px solid; padding: 10px;"><textarea style="width: 100%" name="address" id="address" cols="30" rows="5" disabled>{{$user->address}}</textarea></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    
    <script>
        var errors = @json($errors->all());
        var user = @json($user);
    </script>
    @endsection
    
@endif