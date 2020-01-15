@extends('layouts.register-login')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
    <div class="row">
    <form method="post" action="{{action('ProfilesController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">

            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="card-header">Create your profile and customize your information</div>
            <p>Who is this profile for ?</p>
            <input type="radio" name="role" value="physicians" {{ ($profile->role=="3")? "checked" : "" }} onclick="show1();" />
            Physicians
            <input type="radio" name="role" value="patientsandvolunteers" {{ ($profile->role=="patientsandvolunteers")? "checked" : "" }} onclick="show2();" />
            Patients and Volunteers
            <br>

            <div id="div1" class="hide">
            <hr><p>Patient Information</p>
            First Name
            <input id="patient_first" type="text" class="form-control @error('patient_first') is-invalid @enderror" name="patient_first" value="{{$profile->patient_first}}" required autocomplete="patient_first" autofocus>
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            Last Name
            <input id="patient_last" type="text" class="form-control @error('patient_last') is-invalid @enderror" name="patient_last" value="{{$profile->patient_last}}" required autocomplete="patient_last" autofocus>
            Date
            <input id="patient_date" type="date" class="form-control @error('patient_date') is-invalid @enderror" name="patient_date" value="{{$profile->patient_date}}" required autocomplete="patient_date" autofocus>
            I am volunteering for a clinical study
            <input type="checkbox" value="Yes" name="one">
            <br>
            I have a Medical Condition
            <input type="checkbox" value="Yes" name="two">

            </div>

            <div id="div2" class="hide">
            <hr><p>User Information</p>
            Address
            <input id="address_info" type="text" class="form-control @error('address_info') is-invalid @enderror" name="address_info" value="{{$profile->address_info}}" required autocomplete="address_info" autofocus>
            Contact Information
            <input id="contact_info" type="text" class="form-control @error('contact_info') is-invalid @enderror" name="contact_info" value="{{$profile->contact_info}}" required autocomplete="contact_info" autofocus>
            </div>

            <div id="div2" class="hide">
                    <hr><p>Professional Information</p>
                    <br>
                    Company Information
                    <input id="company_info" type="text" class="form-control @error('company_info') is-invalid @enderror" name="company_info" value="{{ old('company_info') }}" required autocomplete="company_info" autofocus>
                    Job Title
                    <input id="job_title_info" type="text" class="form-control @error('job_title_info') is-invalid @enderror" name="job_title_info" value="{{ old('job_title_info') }}" required autocomplete="job_title_info" autofocus>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>

            <script>
                    function show1()
                    {
                          document.getElementById('div1').style.display ='block';
                          document.getElementById('div2').style.display ='block';

                    }
                    function show2()
                    {
                          document.getElementById('div2').style.display = 'block';
                          document.getElementById('div1').style.display ='none';
                    }
            </script>
        </form>
    </div>
</div>
@endsection
