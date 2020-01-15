@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
<div class="dashbrd-section">
    <div class="page-title-hdng">
      <!--<h5>My Account</h5>-->
      <h1>Research Site</h1>
    </div>
    @if(\Session::has('success'))
    <div class="alert alert-success">
        {{\Session::get('success')}}
    </div>
    @endif
    <div class="clinically-form">
      <form action="">
        <div class="table-details application-detail">
            <table id="personalinfo" class="table tble-bordered">
                    <thead>
                        <tr>
                            <th>Site Number</th>
                            <th>Contact Name</th>
                            <th>Contact Email</th>
                            <th>Contact Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip Code</th>
                        </tr>
                    </thead>
                    <tr>
                        
                        <td>{{ $researchSite->site_number }}</td>
                        <td>{{ $researchSite->contact_name }}</td>
                        <td>{{ $researchSite->contact_email }}</td>
                        <td>{{ $researchSite->contact_phone }}</td>
                        <td>{{ $researchSite->address }}</td>
                        <td>{{ $researchSite->city }}</td>
                        <td>{{ $researchSite->state }}</td>
                        <td>{{ $researchSite->zipcode }}</td>
                    </tr>
                </table>
            </div>
      </form>
    </div>
  </div>
</div>
@endsection
