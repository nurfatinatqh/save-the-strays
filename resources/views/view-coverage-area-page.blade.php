@extends('layouts.design')

@section('content')
  @include('components.header')
  <script>
    if (!document.location.hash){
      document.location.hash = 'here';
    }
  </script>
  <div id="here">
    <section class="module-tips" id="alt-features" style="background-color: white">
      <div class="container"><br><br>
          <h2 class="module-title font-alt">VOLUNTEER COVERAGE AREA</h2>
          <div style="width: 100%; height:500px;" class="container">
              <div id="map"></div>
          </div>
          <br>
          <table style="border: 2px solid cadetblue; width:100%">
              <tr style="border: 1px solid cadetblue">
                  <th>&nbsp;&nbsp;STATE </th>
                  <th>&nbsp;&nbsp;DISTRICT </th>
                  <th>&nbsp;&nbsp;TOTAL VOLUNTEERS </th>
              </tr>
              @foreach ($coverage_list as $key => $coverage)
                  <tr style="border: 1px solid cadetblue">
                      <td>&nbsp;&nbsp;{{$coverage['state']}}</td>
                      <td>&nbsp;&nbsp;{{$key}}</td>
                      <td>&nbsp;&nbsp;{{$coverage['total']}}</td>
                  </tr>
              @endforeach
          </table>
      </div>
    </section>
  </div>
  
  @include('components.footer')

  <script>
    var coverage_list = @json($coverage_list);
    var state_count = @json($state_count);
  </script>


@endsection