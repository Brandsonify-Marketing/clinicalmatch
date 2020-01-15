@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>My Account</h5>
            <h1>Banking Information</h1>
        </div>
        <h3>Overview</h3>
        @if(\Session::has('success'))

        <div class="alert alert-success">
            {{\Session::get('success')}}
        </div>

        @endif
        <div class="clinically-form">        
            <div class="table-details application-detail">
			 <table id="personalinfo" class="table tble-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Account Number</th>
                        <th>Routing Number</th>
                        <th>Location</th>
                        <th>Account Type</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            </div>
            <div class="add_bank">
            <a href="{{ route('account.bank.create')}}" class="btn-typo">Add Bank Details</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function () {
    $('#personalinfo').DataTable({
        "ajax": "{{ url('/') }}/account/bank/ajax"
    });
});
</script>
@endsection