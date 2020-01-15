@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
        <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>Add Payment Information</h1>
            </div>
            <div class="clinically-form">
            <table id="personalinfo" class="table tble-bordered">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Last Four</th>
                        <th>Expiry Month</th>
                        <th>Expiry Year</th>
                    </tr>
                </thead>
            </table>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    @endif
                    <center><label><strong>Please Enter Your Credit Card Information Below:</strong></label></center>
                    <br>
                    @php
                      $route_id = request()->route('id');
                      $principal_details = App\User::where('id', $route_id)->first();
                    @endphp
                    <form action="{{route('add-principal-customer',$route_id)}}" method="POST">
                        {{ csrf_field() }}
                        <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-image="{{ asset('images/fav.jpg')}}"
                                data-locale="auto"
                                data-currency="usd"
                                data-label="Add Details"
                                data-name = "{{$principal_details->firstname}}"
                                data-panel-label="Add Details"
                                data-email="{{$principal_details->email}}"
                                data-allow-remember-me="false">
                        </script>
                    </form>
            </div>
          </div>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function isNumberKey(txt, evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
    if (txt.value.indexOf('.') === - 1) {
    return true;
    } else {
    return false;
    }
    } else {
    if (charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;
    }
    return true;
    }
    function show1(){
      $('#div1').show();
    }
    function show2(){
      $('#div1').hide();
    }
    function show_medical(){
      $('#upload_file').show();
      $('#upload_medical').show();
    }
    function hide_medical(){
      $('#upload_file').hide();
      $('#upload_medical').hide();
    }
</script>    

@endsection
