@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
<div class="dashbrd-section">
    <div class="page-title-hdng">
      <h5>My Account</h5>
      <h1>Professional Information</h1>
    </div>
    <h3>Overview</h3>
    @if(\Session::has('success'))

    <div class="alert alert-success">
        {{\Session::get('success')}}
    </div>
    @endif
    @if(Auth::user()->role_id =='7')
    <div class="clinically-form">
      <form action="">
        <div class="table-details application-detail">
            <table id="proinfo" class="table tble-bordered">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>{{@$profile->job_title_info}}</td>
                        <td>{{@$profile->research_company}}</td>
                        <td>{{@$profile->research_brief}}</td>
                        <td><a href="{{ route('account.professional.edit')}}">Update Your Professional Information</a></td>                   
                    </tr>
                </table>
            </div>
      </form>
    </div>
    @endif
    @if(Auth::user()->role_id =='6')
    <div class="clinically-form">
      <form action="">
        <div class="table-details application-detail">
            <table id="proinfo" class="table tble-bordered">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Specialty</th>
                            <th>Sub Specialty</th>
                            <th>Experience</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>{{@$profile->job_title_info}}</td>
                        <td>{{@$profile->principal_specialty}}</td>
                        <td>{{@$profile->principal_sub_specialty}}</td>
                        <td>{{@$profile->principal_research_experience}}</td>
                        <td><a href="{{ route('account.professional.edit')}}">Update Your Professional Information</a></td>            
                    </tr>
                </table>
            </div>
      </form>
    </div>
    @endif
    @if(Auth::user()->role_id =='5')
    <div class="clinically-form">
      <form action="">
        <div class="table-details application-detail">
            <table id="proinfo" class="table tble-bordered">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>{{@$profile->job_title_info}}</td>
                        <td>{{@$profile->sponsor_company}}</td>
                        <td>{{@$profile->sponsor_brief}}</td>
                        <td><a href="{{ route('account.professional.edit')}}">Update Your Professional Information</a></td>                    
                    </tr>
                </table>
            </div>
      </form>
    </div>
    @endif
    @if(Auth::user()->role_id =='2')
    <div class="clinically-form">
      <form action="">
        <div class="table-details application-detail">
            <table id="proinfo" class="table tble-bordered">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Specialty</th>
                            <th>Sub Specialty</th>
                            <th>Medical License Number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>{{@$profile->job_title_info}}</td>
                        <td>{{@$profile->physician_specialty}}</td>
                        <td>{{@$profile->physician_sub_specialty}}</td>
                        <td>{{@$profile->physician_medical_license}}</td>
                        <td><a href="{{ route('account.professional.edit')}}">Update Your Professional Information</a></td>
                        
                    </tr>
                </table>
            </div>
      </form>
    </div>
    @endif
  </div>
</div>
@endsection
