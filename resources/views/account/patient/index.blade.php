@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
<div class="dashbrd-section">
    <div class="page-title-hdng">
      <h5>My Account</h5>
      <h1>Patient Information</h1>
    </div>
    <h3>Overview</h3>
    @if(\Session::has('success'))
    <div class="alert alert-success">
        {{\Session::get('success')}}
    </div>
    @endif
    <div class="clinically-form">
      <form action="">
            <div class="table-details application-detail">
            <table id="personalinfo" class="table">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Gender</th>
                            <th>Ethnicity</th>
                            <th>Race</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>{{@$profile->patient_first}} {{@$profile->patient_last}}</td>
                        <td>{{@$profile->sex_info}}</td>
                        <td>{{@$profile->ethnicity_info}}</td>
                        <td>{{@$profile->race_info}}</td>
                        <td><a href="{{ route('account.patient.edit') }}">Update Your Patient Information</a></td>
                    </tr>
                </table>
            </div>
      </form>
    </div>
  </div>
</div>
@endsection
