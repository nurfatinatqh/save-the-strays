<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>STS | Save The Strays</title>

  {{-- <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.3/css/bulma.css">
 
  <style>
      body { padding-top: 40px; }
      .color-red { color: red;}
  </style>
</head>
<body class="hold-transition layout-top-nav">

    <div id="app">
        <example-component></example-component>
        <count-box count="150" info="New Orders"></count-box>
        <count-box count="50" info="Failed Orders"></count-box>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <modal v-if="showModal" @close="showModal = false">
                        <template v-slot:header>Hello</template>
                        Can you hear me?
                        {{-- <template v-slot:footer>
                            <button class="button is-success">Save changes</button>
                            <button class="button">Cancel</button>
                        </template> --}}
                    </modal>
                    <button @click="showModal = true">Show Modal</button>
                    <hr>
                    <tabs>
                        <tab name="About Us" :selected="true">
                            <h1>Here is the content for the about us tab.</h1>
                        </tab>
            
                        <tab name="About Our Culture">
                            <h1>Here is the content for the about our culture tab.</h1>
                        </tab>
            
                        <tab name="About Our Vision">
                            <h1>Here is the content for the about our vision tab.</h1>
                        </tab>
                    </tabs>
                    <hr>
                    {{-- <coupon @applied="onCouponApplied"></coupon>
                    <h4 v-if="couponApplied">You used a coupon!</h4> --}}
                    <coupon></coupon>
                    <p v-show="couponApplied">The coupon was applied</p>
                    <hr>
                    <progress-view inline-template>
                        <div>
                            <h4>Your progress through this course is @{{ completionRate }} </h4>
                            <p><button @click="completionRate += 10">Update Completion Rate</button></p>
                        </div>
                    </progress-view>
                    <hr>
                    <app-component></app-component>
                    <hr>
                    <ul>
                        <li v-for="skill in skills">@{{skill}}</li>
                    </ul>
                </div>
                <hr>
            </div>
        </div>
        

        {{-- ul#tabs>li*4>a[href=#] --}}
    </div>
    

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
{{-- <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script> --}}
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
