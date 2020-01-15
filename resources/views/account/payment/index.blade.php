@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>My Account</h5>
            <h1>Payment Information</h1>
        </div>
        <h3>Overview</h3>
        @if(\Session::has('success'))

        <div class="alert alert-success">
            {{\Session::get('success')}}
        </div>

        @endif
        <div class="clinically-form">
            <div class="table-details application-detail">
            <table id="personalinfo" class="table tble-bordered">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Last Four</th>
                        <th>Expiry Month</th>
                        <th>Expiry Year</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            <div class="personal-detail">
                <th class="full-width">                        
                    <form action="{{route('add-card')}}" method="POST">
                        {{ csrf_field() }}
                        <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-image="{{ asset('images/fav.jpg')}}"
                                data-locale="auto"
                                data-currency="usd"
                                data-name="Clinical Match"
                                data-label="Add Card"
                                data-panel-label="Add a New Card"
                                data-email="{{auth()->user()->email}}"
                                data-allow-remember-me="false">
                        </script>
                    </form>
                </th>    
            </div>      
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function () {
    $('#personalinfo').DataTable({
        "ajax": "{{ url('/') }}/account/payment/ajax",
        responsive: true
    });
});
</script>
@endsection
