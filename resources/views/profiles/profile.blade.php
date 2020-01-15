@extends('layouts.register-login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create your profile and customize your information</div>
                <br>
                <p>Who is this profile for</p>
                <input type="radio" name="tab" value="physicians" onclick="show1();" />
                Physicians
                <input type="radio" name="tab" value="patientsandvolunteers" onclick="show2();" />
                Patients and Volunteers

                <div id="div1" class="hide">
                    <hr><p>Patient Information</p>
                    First Name
                    {{-- {{ $user->profile->patient_first }} --}}
                    <input id="patient_first" type="text" class="form-control @error('patient_first') is-invalid @enderror" name="patient_first" value="{{ old('patient_first') }}" required autocomplete="patient_first" autofocus>
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    Last Name
                    <input id="patient_last" type="text" class="form-control @error('patient_last') is-invalid @enderror" name="patient_last" value="{{ old('patient_last') }}" required autocomplete="patient_last" autofocus>
                    Date
                    <input id="patient_date" type="date" class="form-control @error('patient_date') is-invalid @enderror" name="patient_date" value="{{ old('patient_date') }}" required autocomplete="patient_date" autofocus>
                    I am volunteering for a clinical study
                    <input type="checkbox" value="Yes" name="one">
                    I have a Medical Condition
                    <input type="checkbox" value="Yes" name="two">
                </div>

                <div id="div2" class="hide">
                    <hr><p>User Information</p>
                    Address
                    <input id="address_info" type="text" class="form-control @error('address_info') is-invalid @enderror" name="address_info" value="{{ old('address_info') }}" required autocomplete="address_info" autofocus>
                    Contact Information
                    <input id="contact_info" type="text" class="form-control @error('contact_info') is-invalid @enderror" name="contact_info" value="{{ old('contact_info') }}" required autocomplete="contact_info" autofocus>
                </div>
            </div>

            <script>
                function show1()
                {
                    document.getElementById('div1').style.display = 'block';
                    document.getElementById('div2').style.display = 'block';

                }
                function show2()
                {
                    document.getElementById('div2').style.display = 'block';
                    document.getElementById('div1').style.display = 'none';
                }
            </script>

            <form method="GET" action="/nextpage">
                @csrf
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Upload
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<style>
    .hide
    {
        display: none;
    }
    p
    {
        font-weight: bold;
    }
</style>
@endsection
