@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>My Account</h5>
            <h1>Non Profit Information</h1>
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
                        <th>Charity</th>
                        <th>Address</th>
                        <th>Amount Donated</th>
                        <th>ACH</th>
                        <th></th>
                        <th></th>
                    </tr>       
                </thead>
            </table>
            <th class="full-width"><a href="{{ route('account.charity.create')}}" class="btn-typo">Add a Charity</a></th>
        </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function () {
    $('#personalinfo').DataTable({
        "ajax": "{{ url('/') }}/account/charity/ajax"
    });
});
</script>
@endsection
