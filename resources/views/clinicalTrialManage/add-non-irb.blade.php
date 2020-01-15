@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
        @if ($errors->any())
            <div class="alert alert-danger  w-100">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif

        @if(\Session::has('success'))
            <div class="alert alert-success  w-100">
                {{\Session::get('success')}}
            </div>
        @endif
        <div class="dashbrd-section">
          <div class="page-title-hdng">
            <h5>Clinical Trial Management</h5>
            <h1>Submit Clinical Trials</h1>
            <ul>
              <li>
                <a href="{{ route('clinicalTrialManage.create-irb') }}">IRB Approval Required</a>
              </li>
              <li>
                <a href="javascript:void(0)" class="active">IRB Approval Not Required</a>
              </li>
            </ul>
          </div>
          <div class="clinically-form">
            <form method="post" action="{{ route('clinicalTrialManage.store-non-irb') }}" id="non-irb-form">
              @csrf
              <input type="hidden" value="{{ csrf_token() }}" name="_token" />
              <div class="row">
                <div class="col-12 col-md-6 form-fields">
                <label>Full Title of Study</label>
                <input type="text" class="form-control @error('study_title') is-invalid @enderror" id="study_title" name="study_title" value="{{ old('study_title') }}" required autocomplete="study_title" autofocus>
                @error('study_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-12 col-md-6 form-fields">
                  <label>Principal Investigator’s Name</label>
                  <input type="text" class="form-control @error('private_name') is-invalid @enderror" name="private_name" value="{{ old('private_name') }}" required autocomplete="private_name" autofocus>
                  @error('private_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-12 col-md-6 form-fields">
                  <label>Research Site Name</label>
                  <input type="text" class="form-control @error('site_name') is-invalid @enderror" name="site_name" value="{{ old('site_name') }}" required autocomplete="site_name" autofocus>
                  @error('site_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
            <div class="col-6 col-md-6 form-fields">
              <label>Number of Visits</label>
                 <select name="no_of_visits">
                 <option selected="selected" disabled><strong>--Number of Visits--</strong></option> 
                <?php
                    for ($i=1; $i<=50; $i++)
                    {
                        ?>
                            <option {{ old('no_of_visits') == $i ? "selected" : "" }} value="{{ $i }}">{{$i}}</option>
                        <?php
                    }
                ?>
                </select>
                  @error('no_of_visits')
                  <span class="invalid-feedback" role="alert">
                      <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror
            </div>
                <div class="col-12 col-md-4 form-fields">
                  <label>Address</label>
                  <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                  @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-12 col-md-4 form-fields">
                  <label>City</label>
                  <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                  @error('city')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-12 col-md-2 form-fields">
                    <label>State</label>
                    <div class="select-box">
                <select name="state">
                        <option selected="selected" disabled>State</option> 
                        <option value="Alabama" @if (old('state') == "Alabama") {{ 'selected' }} @endif>Alabama</option>
                        <option value="Alaska" @if (old('state') == "Alaska") {{ 'selected' }} @endif>Alaska</option>
                        <option value="Arizona" @if (old('state') == "Arizona") {{ 'selected' }} @endif>Arizona</option>
                        <option value="Arkansas" @if (old('state') == "Arkansas") {{ 'selected' }} @endif>Arkansas</option>
                        <option value="California" @if (old('state') == "California") {{ 'selected' }} @endif>California</option>
                        <option value="Colorado" @if (old('Colorado') == "Colorado") {{ 'selected' }} @endif>Colorado</option>
                        <option value="Connecticut" @if (old('state') == "Connecticut") {{ 'selected' }} @endif>Connecticut</option>
                        <option value="Delaware" @if (old('state') == "Delaware") {{ 'selected' }} @endif>Delaware</option>
                        <option value="District Of Columbia" @if (old('state') == "District Of Columbia") {{ 'selected' }} @endif>District Of Columbia</option>
                        <option value="Florida" @if (old('state') == "Florida") {{ 'selected' }} @endif>Florida</option>
                        <option value="Georgia" @if (old('state') == "Georgia") {{ 'selected' }} @endif>Georgia</option>
                        <option value="Hawaii" @if (old('state') == "Hawaii") {{ 'selected' }} @endif>Hawaii</option>
                        <option value="Idaho" @if (old('state') == "Idaho") {{ 'selected' }} @endif>Idaho</option>
                        <option value="Illinois" @if (old('state') == "Illinois") {{ 'selected' }} @endif>Illinois</option>
                        <option value="Indiana" @if (old('state') == "Indiana") {{ 'selected' }} @endif>Indiana</option>
                        <option value="Iowa" @if (old('state') == "Iowa") {{ 'selected' }} @endif>Iowa</option>
                        <option value="Kansas" @if (old('state') == "Kansas") {{ 'selected' }} @endif>Kansas</option>
                        <option value="Kentucky" @if (old('state') == "Kentucky") {{ 'selected' }} @endif>Kentucky</option>
                        <option value="Louisiana" @if (old('state') == "Louisiana") {{ 'selected' }} @endif>Louisiana</option>
                        <option value="Maine" @if (old('state') == "Maine") {{ 'selected' }} @endif>Maine</option>
                        <option value="Maryland" @if (old('state') == "Maryland") {{ 'selected' }} @endif>Maryland</option>
                        <option value="Massachusetts" @if (old('state') == "Massachusetts") {{ 'selected' }} @endif>Massachusetts</option>
                        <option value="Michigan" @if (old('state') == "Michigan") {{ 'selected' }} @endif>Michigan</option>
                        <option value="Minnesota" @if (old('state') == "Minnesota") {{ 'selected' }} @endif>Minnesota</option>
                        <option value="Mississippi" @if (old('state') == "Mississippi") {{ 'selected' }} @endif>Mississippi</option>
                        <option value="Missouri" @if (old('state') == "Missouri") {{ 'selected' }} @endif>Missouri</option>
                        <option value="Montana" @if (old('state') == "Montana") {{ 'selected' }} @endif>Montana</option>
                        <option value="Nebraska" @if (old('state') == "Nebraska") {{ 'selected' }} @endif>Nebraska</option>
                        <option value="Nevada" @if (old('state') == "Nevada") {{ 'selected' }} @endif>Nevada</option>
                        <option value="New Hampshire" @if (old('state') == "New Hampshire") {{ 'selected' }} @endif>New Hampshire</option>
                        <option value="New Jersey" @if (old('state') == "AL") {{ 'selected' }} @endif>New Jersey</option>
                        <option value="New Mexico" @if (old('state') == "AL") {{ 'selected' }} @endif>New Mexico</option>
                        <option value="New York" @if (old('state') == "New York") {{ 'selected' }} @endif>New York</option>
                        <option value="North Carolina" @if (old('state') == "North Carolina") {{ 'selected' }} @endif>North Carolina</option>
                        <option value="North Dakota" @if (old('state') == "North Dakota") {{ 'selected' }} @endif>North Dakota</option>
                        <option value="Ohio" @if (old('state') == "Ohio") {{ 'selected' }} @endif>Ohio</option>
                        <option value="Oklahoma" @if (old('state') == "Oklahoma") {{ 'selected' }} @endif>Oklahoma</option>
                        <option value="Oregon" @if (old('state') == "Oregon") {{ 'selected' }} @endif>Oregon</option>
                        <option value="Pennsylvania" @if (old('state') == "Pennsylvania") {{ 'selected' }} @endif>Pennsylvania</option>
                        <option value="Rhode Island" @if (old('state') == "Rhode Island") {{ 'selected' }} @endif>Rhode Island</option>
                        <option value="South Carolina" @if (old('state') == "South Carolina") {{ 'selected' }} @endif>South Carolina</option>
                        <option value="South Dakota" @if (old('state') == "South Dakota") {{ 'selected' }} @endif>South Dakota</option>
                        <option value="Tennessee" @if (old('state') == "Tennessee") {{ 'selected' }} @endif>Tennessee</option>
                        <option value="Texas" @if (old('state') == "Texas") {{ 'selected' }} @endif>Texas</option>
                        <option value="Utah" @if (old('state') == "Utah") {{ 'selected' }} @endif>Utah</option>
                        <option value="Vermont" @if (old('state') == "Vermont") {{ 'selected' }} @endif>Vermont</option>
                        <option value="Virginia" @if (old('state') == "Virginia") {{ 'selected' }} @endif>Virginia</option>
                        <option value="Washington" @if (old('state') == "Washington") {{ 'selected' }} @endif>Washington</option>
                        <option value="West Virginia" @if (old('state') == "West Virginia") {{ 'selected' }} @endif>West Virginia</option>
                        <option value="Wisconsin" @if (old('state') == "Wisconsin") {{ 'selected' }} @endif>Wisconsin</option>
                        <option value="Wyoming" @if (old('state') == "Wyoming") {{ 'selected' }} @endif>Wyoming</option>
                        <option value="American Samoa" @if (old('state') == "American Samoa") {{ 'selected' }} @endif>American Samoa</option>
                        <option value="Guam" @if (old('state') == "Guam") {{ 'selected' }} @endif>Guam</option>
                        <option value="Northern Mariana Islands" @if (old('state') == "Northern Mariana Islands") {{ 'selected' }} @endif>Northern Mariana Islands</option>
                        <option value="Puerto Rico" @if (old('state') == "Puerto Rico") {{ 'selected' }} @endif>Puerto Rico</option>
                        <option value="United States Minor Outlying Islands" @if (old('state') == "United States Minor Outlying Islands") {{ 'selected' }} @endif>United States Minor Outlying Islands</option>
                        <option value="Virgin Islands" @if (old('state') == "Virgin Islands") {{ 'selected' }} @endif>Virgin Islands</option>
                        <option value="Armed Forces Americas" @if (old('state') == "Armed Forces Americas") {{ 'selected' }} @endif>Armed Forces Americas</option>
                        <option value="Armed Forces Pacific" @if (old('state') == "Armed Forces Pacific") {{ 'selected' }} @endif>Armed Forces Pacific</option>
                        <option value="Armed Forces Others" @if (old('state') == "Armed Forces Others") {{ 'selected' }} @endif>Armed Forces Others</option> 
                </select>
                        </div>
                        @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                   <div class="col-12 col-md-2 form-fields">
              <label>Zip Code</label>
              <input type="text" maxlength="5" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>
              @error('zipcode')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-6 col-md-6 form-fields">
              <label>Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror"  id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 col-md-6 form-fields">
              <label>Phone</label>
              <input type="text" maxlength="10" class="form-control @error('phone_no') is-invalid @enderror" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required autocomplete="phone_no" autofocus>
              @error('phone_no')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
<!--                 <div class="col-12 form-fields">
                <div class="radio-selector text-center">
                        <label>Is this open to one of the following?</label>
                            <ul>
                            <li>
                                <input type="radio" name="vol_condition" onclick="hide_condition();" value="healthy" {{ old('vol_condition') ? 'checked' : '' }}>
                                <label>Healthy volunteers</label>
                            </li>
                            <li>
                                <input type="radio" name="vol_condition" onclick="show_condition();" value="medical_condition" {{ old('vol_condition') ? 'checked' : '' }}>
                                <label>Volunteers with a medical condition</label>
                            </li>
                            </ul>
                  </div>
                  @error('vol_condition')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-12 form-fields" id="med_condition" style="display:none">
                <label>Medical Condition</label>
                <select id="med" multiple="multiple" name="medical_condition">
                        <option value="1">Item 1</option>
                        <option value="2">Item 2</option>
                        <option value="3">Item 3</option>
                        <option value="4">Item 4</option>
                        <option value="5">Item 5</option>
                        <option value="6">Item 6</option>
                        <option value="7">Item 7</option>
                        <option value="8">Item 8</option>
                        <option value="9">Item 9</option>
                        <option value="10">Item 10</option>
                </select>
                @error('medical_condition')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div> -->
                <div class="col-12 form-fields">
                  <label>Purpose of the study </label>
                  <textarea type="text" class="form-control" id="rationale" name="rationale">{{ old('rationale') }}</textarea>
                </div>
                <div class="col-12 form-fields">
                        <label>Expiry Date</label>
                        <input type="text" class="expiry form-control @error('expiry_date') is-invalid @enderror" name="expiry_date" value="{{old('expiry_date') ? old('expiry_date') : ''}}" required autocomplete="expiry_date" autofocus>
                        @error('expiry_date')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                <div class="col-12 form-fields">
                  <label>Summary of the inclusion and exclusion criteria</label>
                  <textarea type="text" class="form-control" id="summary_exc_inc" name="summary_exc_inc">{{ old('summary_exc_inc') }}</textarea>
                  @if ($errors->has('summary_exc_inc')) <p style="color:red;">{{ $errors->first('summary_exc_inc') }}</p> @endif
                </div>
                <div class="w-100 row ml-0 mr-0 sub-invest">
                  <div class="col-12 col-md-12 form-fields">
                    <div class="text-left text-md-left">
                      <div class="d-inline-block text-center">
                            <label>Is a Placebo drug involved? </label>
                            <div class="radio-selector">
                              <ul>
                                <li>
                                <input type="radio" name="placebo" value="1" {{ old('placebo') ? 'checked' : '' }}>
                                  <label>yes</label>
                                </li>
                                <li>
                                <input type="radio" name="placebo" value="0" {{ old('placebo') ? 'checked' : '' }}>
                                  <label>no</label>
                                </li>
                              </ul>
                            </div>
                      </div>
                      @error('placebo')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                </div>
                <div class="col-12 form-fields">
                  <label>List of participation benefits (e.g., a no-cost health examination)</label>
                  <textarea type="text" class="form-control" id="participation" name="participation">{{ old('participation') }}</textarea>
                </div>
                <div class="col-12 text-center text-md-right">
                  <a href="#" class="btn-typo" data-toggle="modal" data-target="#review-modal" id="submitBtn">SUBMIT</a>
                  <input type="submit" value="submit" class="btn-typo" name=""  data-toggle="modal" data-target="#review-modal" style="display:none;">
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal sdf syposis-modal fade" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-logo text-center">
            <a href="#">
              <img src="{{ asset('images/logo.png')}}">
            </a>
          </div>
          <div class="modal-txt">
            <h4>Clinical Study Synopsis</h4>
            <p>It is your responsibility to obtain permission from your IRB before listing a clinical study. Please visit the FDA guidance entitled, <a href="#">Recruiting Study Subjects – Information Sheet,</a>  which addresses IRB review and approval of clinical trials listings on the internet when the provided material goes beyond basic trial information, such as the title, purpose, protocol summary, basic eligibility criteria, locations and contact information. <a href="#">https://www.fda.gov/regulatory-information/search-fda-guidance-documents/recruiting-study-subjects</a></p>
          </div>
          <div class="addinital-info">
            <!-- <a href="javascript:void(0);" class="agree-form">I AGREE</a> -->
            <button class="btn-typo agree-form">I AGREE</a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
<script>
        function show_condition(){
            $('#med_condition').show();
        }
        function hide_condition(){
            $('#med_condition').hide();
        }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    $(".agree-form").click(function(){
       $("#non-irb-form").trigger("submit");
    });
    });
</script>


@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<!-- <script type="text/javascript">
  $('.expiry').datepicker({
        format: "dd-mm-yyyy"
  });
</script> -->

<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.11/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript">
              $(document).ready(function () {
                    $('#phone_no').usPhoneFormat();
              });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script>
  $(function() {
    $('input[name="expiry_date"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minDate: moment(),
      minYear: 2020,
      maxYear: 2040
    });
    $('input[name="expiry_date"]').val('MM-DD-YYYY');
  });
  </script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#med').multiselect({
            enableFiltering: true,
            filterPlaceholder: 'Search'
        });
    });
</script>


@endsection
