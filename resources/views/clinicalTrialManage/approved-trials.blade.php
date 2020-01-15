@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
    @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
    @endif
    <div class="dashbrd-section">
      <div class="page-title-hdng">
        <h5>Clinical Trial Management</h5>
        <h1>Review & Approve Clinical Trials</h1>
      </div>
      <div class="clinically-form">
        <div class="table-tab">
          <ul>
              <li>
              <a href="{{ route('clinicalTrialManage.review')}}">
              <!-- <input type="radio" name="review-tab-slct"> -->
              <label>All Trials</label>
            </a>
            </li>
            <li class="active">
              <a href="{{ route('clinicalTrialManage.approved-trials')}}">
              <label>Approved Trials</label>
              </a>
            </li>
            <li>
              <a href="{{ route('clinicalTrialManage.pending-trials')}}">
              <!-- <input type="radio" name="review-tab-slct"> -->
              <label>Pending Trials</label>
              </a>
            </li>
            <li>
              <!-- <input type="radio" name="review-tab-slct"> -->
              <a href="{{ route('clinicalTrialManage.declined-trials')}}">
              <label>Declined Trials</label>
              </a>
            </li>
          </ul>
        </div>
<!--         <div class="submit-paymnt">
          <a href="#">Submit Payments</a>
        </div> -->
        <div class="table-details">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Name of Clinical Trial</th>
                <th scope="col">Posted</th>
                <th scope="col">Expires</th>
                <th scope="col"># of Patients</th>
                <th scope="col">Form Type</th>
              </tr>
            </thead>
            <tbody>
            @foreach($clinicaltrials as $clinicaltrial)
              <tr class="list-item">
                <td data-label="Name of Clinical Trial">{{ $clinicaltrial->study_title }}</td>
                <td data-label="Posted: ">{{ \Carbon\Carbon::parse($clinicaltrial->created_at)->format('d.m.Y')}}</td>
                <td data-label="Expires: ">{{ ($clinicaltrial->expiry_date) }}</td>
                <td data-label="# of Patients: ">0</td>
                <td data-label="Type">                
                @if($clinicaltrial->form_type == 1)
                    IRB 
                @else
                    NON IRB
                @endif</td>
                <td><a href="{{ route('clinicalTrialManage.review-trial', $clinicaltrial->id) }}">View</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="more-detail">
          <a href="javascript:void(0):" id = "ViewMoreListItem">view more</a>
        </div>
      </div>
    </div>
</div>

@endsection
