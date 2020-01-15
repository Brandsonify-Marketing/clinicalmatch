@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
        <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>Update Patient Information</h1>
            </div>
            <div class="submit-paymnt back-btn">
                  <a href="{{ route('account.patient.index') }}">Back</a>
            </div>
            <div class="clinically-form">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    @endif

                    <form action="{{ route('account.patient.update') }}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="patient_first">Patient First Name:</label>
                            <input type="text" class="form-control" name="patient_first" value="{{ @$profile->patient_first }}">
                        </div>
                        <div class="form-group">
                            <label for="patient_last">Patient Last Name:</label>
                            <input type="text" class="form-control" name="patient_last" value="{{ @$profile->patient_last }}">
                        </div>
                        <div class="form-group">
                            <label for="patient_last">Patient Date:</label>
                            <input onkeydown="return false" type="text" class="date form-control" name="patient_date" value="{{ @$profile->patient_date }}">
                        </div>
                        <div class="form-group">
                            <label for="patient_phy__name">Physician Name:</label>
                            <input type="text" class="form-control" name="patient_phy__name" value="{{ @$profile->patient_phy__name }}">
                        </div>
                        <div class="form-group">
                            <label for="patient_phy__email">Physician Email:</label>
                            <input type="email" class="form-control" name="patient_phy__email" value="{{ @$profile->patient_phy__email }}">
                        </div>
                        <div class="form-group">
                            <label for="patient_phy__phone">Physician Phone:</label>
                            <input type="text" maxlength="10" class="form-control" placeholder="xxx-xxx-xxxx" name="patient_phy__phone" onkeypress="return isNumberKey(this, event);" value="{{ @$profile->patient_phy__phone }}">
                        </div>
                        <div class="form-group">
                            <label for="care_giver_name">Caregiver Name:</label>
                            <input type="text" class="form-control" name="care_giver_name" value="{{ @$profile->care_giver_name }}">
                        </div>
                        <div class="form-group">
                            <label for="care_giver_email">Caregiver Email:</label>
                            <input type="email" class="form-control" name="care_giver_email" value="{{ @$profile->care_giver_email }}">
                        </div>
                        <div class="form-group">
                            <label for="care_giver_phone">Caregiver Phone:</label>
                            <input type="text" maxlength="10" class="form-control" placeholder="xxx-xxx-xxxx" name="care_giver_phone" onkeypress="return isNumberKey(this, event);" value="{{ @$profile->care_giver_phone }}">
                        </div>
                        <div class="form-group">
                            <label for="race_info">Race</label>
                            <input type="text" class="form-control" name="race_info" value="{{ @$profile->race_info }}">
                        </div>
                        <div class="form-group">
                            <label for="preferred_lang">Preferred Language of Communication:</label>
                            <input type="text" class="form-control" name="preferred_lang" value="{{ @$profile->preferred_lang }}">
                        </div>
<!--                         <div class="form-group">
                            <label for="education_info">Education:</label>
                            <input type="text" class="form-control" name="education_info" value="{{ @$profile->education_info }}">
                        </div>
                        <div class="form-group">
                            <label for="occupation_info">Occupation:</label>
                            <input type="text" class="form-control" name="occupation_info" value="{{ @$profile->occupation_info }}">
                        </div>
                       <div class="form-group">
                            <label for="contact">Income:</label>
                            <input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="income_info" value={{ @$profile->income_info }}>
                        </div> -->
                       <div class="form-group">
                            <label for="sex_info">Gender:</label>
                            <br>
                            <select name="sex_info" class="form-control">
                              <option selected="selected" disabled>--Gender--</option> 
                              <option {{{ (isset($profile->sex_info) && $profile->sex_info == 'Male') ? "selected=\"selected\"" : (old('sex_info') == 'Male') ? 'selected' : '' }}}>Male</option>
                               <option {{{ (isset($profile->sex_info) && $profile->sex_info == 'Female') ? "selected=\"selected\"" : (old('sex_info') == 'Female') ? 'selected' : '' }}}>Female</option>
                              <option {{{ (isset($profile->sex_info) && $profile->sex_info == 'Other') ? "selected=\"selected\"" : (old('sex_info') == 'Other') ? 'selected' : '' }}}>Other</option>
                            </select>
                          @error('sex_info')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label for="ethnicity_info">Ethnicity:</label>
                            <br>
                             <select name="ethnicity_info" class="form-control">
                              <option selected="selected" disabled>--Ethnicity--</option> 
                              <option {{{ (isset($profile->ethnicity_info) && $profile->ethnicity_info == 'hispanic') ? "selected=\"selected\"" : (old('ethnicity_info') == 'hispanic') ? 'selected' : '' }}} value="hispanic" >Hispanic</option>
                              <option  {{{ (isset($profile->ethnicity_info) && $profile->ethnicity_info == 'nonhispanic') ? "selected=\"selected\"" : (old('ethnicity_info') == 'nonhispanic') ? 'selected' : '' }}} value="nonhispanic">Non-Hispanic</option>
                            </select>
                          @error('ethnicity_info')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <button type="submit" class="btn-typo">Update</button>
                    </form>
            </div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            function isNumberKey(txt, evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === - 1) {
            return true;
            } else {
            return false;
            }
            } else {
            if (charCode > 31
                    && (charCode < 48 || charCode > 57))
                    return false;
            }
            return true;
            }
        </script>

@endsection
@section('scripts')
<!--   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
    $('.date').datepicker({  
          format: "dd-mm-yyyy",
          endDate: '-1d'
    });  
  </script>  -->

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script>
  $(function() {
    $('input[name="date"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minDate: moment(),
      minYear: 2020,
      maxYear: 2040
    });
    $('input[name="date"]').val('MM-DD-YYYY');
  });
  </script>
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.11/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
                  $('input[name="patient_phy__phone"],input[name="care_giver_phone"],input[name="physician_clinic_tele"],input[name="clinic_person_telephone"],input[name="sponsor_per_tele"],input[name="sponsor_comp_tele"],input[name="principal_site_telephone"],input[name="principal_telephone"],input[name="research_per_tele"],input[name="research_comp_tele"]').usPhoneFormat();
            });
</script>
@endsection
