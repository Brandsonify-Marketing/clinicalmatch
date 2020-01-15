@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
        <div class="dashbrd-section">
          <div class="page-title-hdng">
            <h5>Find a Clinical Trial</h5>
            <h1>Clinical Trial Application</h1>
          </div>
          @php
          $route_id = request()->route('id');
          @endphp
          <div class="submit-paymnt back-btn">
                  <a href="{{ route('clinicalTrial.view',$route_id) }}">Back To Clinical Trial</a>  
          </div>
          <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
            @php
            $route_id = request()->route('id');
            $trial_name = App\ClinicalTrial::where('id', $route_id)->first();
            @endphp
             <a href="{{ route('clinicalTrial.index') }}">Find a Clinical Trial</a>  > 
             <a href="{{ route('clinicalTrial.view', $route_id) }}"> View Trial</a>  >
             <a href="{{ route('clinicalTrial.apply', $route_id) }}"> Clinical Trial Application</a>  >
             <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
         </div>
          <div class="clinically-form">
           <form method="post" action="{{ route('clinicalTrial.applied',$clinicaltrial->id)}}"  enctype="multipart/form-data">
                    @csrf
              <div class="row">
                @if(isset($user->firstname) && !empty($user->firstname) || isset($user->lastname) && !empty($user->lastname))
                <div class="col-12 form-fields">               
                  <strong>{{$user->firstname. " " .$user->lastname}}</strong>          
                </div>
                @endif
                <br>
                @if(isset($profile->patientdate) && !empty($profile->patientdate))
                <div class="col-12 form-fields">                
                        <strong>Date of Birth : {{ \Carbon\Carbon::parse($profile->patientdate)->format('jS F Y')}} </strong>                 
                </div>
                @endif
                @if(isset($profile->addressinfo) && !empty($profile->addressinfo))
                <div class="col-12 form-fields">                 
                        <strong>Address:
                        <br>
                        {{ $profile->addressinfo }}</strong>            
                </div>
                @endif
                @if(isset($profile->contactinfo) && !empty($profile->contactinfo))
                <div class="col-12 form-fields">            
                        <strong>Contact:
                        <br>
                        {{ $profile->contactinfo }}</strong>
                </div>
                @endif
                <div class="col-12 form-fields">
                        @if($clinicaltrial->vol_condition == 0)
                        <strong>Type: Not Healthy Volunteer</strong>
                        <br>
                        @else
                        <strong>Type: Healthy Volunteer</strong>
                        @endif
                </div>
                <div class="col-12 form-fields">
                  <label>Medical History</label>
                  <textarea type="text" class="form-control @error('medical_history') is-invalid @enderror" id="medical_history" name="medical_history">{{ old('medical_history') }}</textarea>
                </div>
                <div class="col-12 form-fields">
                  <label>Laboratory Results & Date</label>
                  <textarea type="text" class="form-control @error('lab_results') is-invalid @enderror" id="lab_results" name="lab_results">{{ old('lab_results') }}</textarea>
                </div>
                <div class="col-12 form-fields">
                        <label>Medications</label>
                            <input type="text" class="form-control @error('medications') is-invalid @enderror" name="medications" value="{{ old('medications') }}" autocomplete="medications" autofocus>
                                @error('medications')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="col-12 form-fields">
                  <div class="error">*Before uploading a medical record or laboratory report you are advised to hide personal information like name, address and social security number by using a black out pen or white pen or by using other secure means.</div>
                </div>
              <div class="col-12 form-fields">
                    <label>Upload Medical Records</label>
                          <div class="links">
                            <input type="file" 
                               class="filepond"
                               name="image_name[]"
                               multiple
                               data-max-file-size="3MB"
                               data-max-files="10" />
                          </div>
                      </div>
                  </div>
                <div class="col-12 text-center text-md-right">
                  <input type="submit" value="submit" class="btn-typo" name="">
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
    <!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script>
    FilePond.registerPlugin();
    var element = document.querySelector('meta[name="csrf-token"]');
    var csrf = element && element.getAttribute("content");
    FilePond.setOptions({
      server: {
            url: "{{ url('clinical-trial/upload')}}",
            process: {
                headers: {
                  'X-CSRF-TOKEN': csrf 
                },
            }
        }
    });
    const inputElement = document.querySelector('input[name="image_name[]"]');
    const pond = FilePond.create( inputElement );
    </script>
@endsection

@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $('.date').datepicker({
        format: "dd-mm-yyyy"
  });
</script>
@endsection
