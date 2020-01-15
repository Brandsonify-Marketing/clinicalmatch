@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
    @if ($errors->any())

            <div class="alert alert-danger w-100">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
    @endif

    @if(\Session::has('success'))
            <div class="alert alert-success w-100">
                {{\Session::get('success')}}
            </div>
    @endif
    <style>
    img {
      max-width: 200px;
    }
    .btn_upload {
  cursor: pointer;
  display: inline-block;
  overflow: hidden;
  position: relative;
  color: #fff;
  background-color: #2a72d4;
  border: 1px solid #166b8a;
  padding: 5px 10px;
}

.btn_upload:hover,
.btn_upload:focus {
  background-color: #7ca9e6;
}

.yes {
  display: flex;
  align-items: flex-start;
  margin-top: 10px !important;
}

.btn_upload input {
  cursor: pointer;
  height: 100%;
  position: absolute;
  filter: alpha(opacity=1);
  -moz-opacity: 0;
  opacity: 0;
}

.it {
  height: 100px;
  margin-left: 10px;
}

.btn-rmv1 {
  display: none;
}

.rmv {
  cursor: pointer;
  color: #fff;
  border-radius: 30px;
  border: 1px solid #fff;
  display: inline-block;
  background: rgba(255, 0, 0, 1);
  margin: -5px -10px;
}

.rmv:hover {
  background: rgba(255, 0, 0, 0.5);
}

  </style>

    <div class="dashbrd-section">
      <div class="page-title-hdng">
        <h5>Clinical Trial Management</h5>
        <h1>Submit Clinical Trials</h1>
        <ul>
          <li>
            <a href="javascript:void(0);" class="active">IRB Approval Required</a>
          </li>
          <li>
            <a href="{{ route('clinicalTrialManage.create-non-irb') }}">IRB Approval Not Required</a>
          </li>
        </ul>
      </div>
      <div class="clinically-form">
        <form method="post" action="{{ route('clinicalTrialManage.store-irb') }}" id="irb-form" enctype="multipart/form-data">
          @csrf
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
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
              <input type="text" class="form-control @error('private_name') is-invalid @enderror" id="private_name"  name="private_name" value="{{ (@old('private_name') ? old('private_name') : $principal_investigator) }}" required autocomplete="private_name" autofocus>
              @error('private_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 col-md-6 form-fields">
              <label>Research Site Name</label>
              <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" name="site_name" value="{{ old('site_name') }}" required autocomplete="site_name" autofocus>
              @error('site_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-6 col-md-6 form-fields">
              <label><strong>Number of Visits</strong></label>
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
              <div class="select-box" >
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
            </div> <div class="col-12 col-md-2 form-fields">
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
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
            <div class="col-12 form-fields">
              <div class="radio-selector text-center">
              <label>Is this open to one of the following?</label>
                <ul>
                  <li>
                    <input type="radio" name="vol_condition" id="vol_condition" onclick="hide_condition();" value="healthy" {{ old('vol_condition') == 'healthy'? 'checked' : '' }}>
                    <label>Healthy volunteers</label>
                  </li>
                  <li>
                    <input type="radio" name="vol_condition" id="vol_condition" onclick="show_condition();" value="medical_condition" {{ old('vol_condition') == 'medical_condition' ? 'checked' : '' }}>
                    <label>Volunteers with a medical condition</label>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 form-fields" id="med_condition" style="display:none">
              <label>Medical Condition</label>
              <input class="typeahead form-control" type="text" name="medical_condition" id="medical_condition" value="{{ old('medical_condition') }}">
              @error('medical_condition')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col-12 form-fields">
              <label>Rationale for study</label>
              <textarea type="text" class="form-control @error('exc_criteria') is-invalid @enderror" id="rationale" name="rationale">{{ old('rationale') }}</textarea>
            </div>
            <div class="w-100 row ml-0 mr-0 sub-invest">
              <div class="col-12 col-md-6 form-fields">
                <div class="text-center text-md-right">
                  <div class="d-inline-block text-center">
                        <label>Do you accept sub-investigators to this study?</label>
                        <div class="radio-selector">
                          <ul>
                            <li>
                            <input type="radio" name="sub_accept" value="1" {{ old('sub_accept') == '1'? 'checked' : '' }}>
                              <label>yes</label>
                            </li>
                            <li>
                            <input type="radio" name="sub_accept" value="0" {{ old('sub_accept') =='0'? 'checked' : '' }}>
                              <label>no</label>
                            </li>
                          </ul>
                        </div>
                  </div>
                  @error('sub_accept')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              @if(Auth::user()->role_id =='2')
              <div class="col-12 col-md-6 form-fields">
                <div class="d-md-inline-block text-center">
                    <label>Enter the Synopsis</label>
                    {{-- <a href="#" data-toggle="modal" data-target="#exampleModalCenter" class="btn-typo">View</a> --}}
                    <input type="button" name="btn" value="View" id="submitBtn" data-toggle="modal" data-target="#exampleModalCenter" class="btn-typo" />
                    <h6>For registered physicians</h6>
                </div>
              </div>
              @else
            <div class="col-12 col-md-6 form-fields">
                <div class="d-md-inline-block text-center">
                    <h6>For registered physicians only:</h6>
                </div>
              </div>
              @endif
            </div>
            <div class="col-12 form-fields">
              <label>Class of drug/device</label>
              <input type="text" class="form-control @error('drug_class') is-invalid @enderror" name="drug_class" value="{{ old('drug_class') }}" required autocomplete="drug_class" autofocus>
              @error('drug_class')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 form-fields">
              <label>Mechanism of drug/device</label>
              <input type="text" class="form-control @error('mechanism') is-invalid @enderror" name="mechanism" value="{{ old('mechanism') }}" required autocomplete="mechanism" autofocus>
              @error('mechanism')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 form-fields">
              <label>List of participation benefits</label>
              {{-- <input type="text" class="form-control @error('list_benefits') is-invalid @enderror" name="list_benefits" value="{{ old('list_benefits') }}" required autocomplete="list_benefits" autofocus>
              @error('list_benefits')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror --}}
              <textarea type="text" class="form-control" id="list_benefits" name="list_benefits">{{ old('list_benefits') }}</textarea>
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
              <label>Inclusion Criteria</label>
              <textarea type="text" class="form-control @error('inc_criteria') is-invalid @enderror" id="inc_criteria" name="inc_criteria">{{ old('inc_criteria') }}</textarea>
            </div>
            @error('inc_criteria')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            <div class="col-12 form-fields">
              <label>Exclusion Criteria</label>
              <textarea type="text" class="form-control @error('exc_criteria') is-invalid @enderror" id="exc_criteria" name="exc_criteria">{{ old('exc_criteria') }}</textarea>
            </div>
            @error('exc_criteria')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            <div class="col-12 form-fields">
              <label>Is Placebo drug involved?</label>
              <div class="d-inline-block">
                <div class="radio-selector">
                  <ul>
                    <li>
                      <input type="radio" name="placebo" value="1" {{ old('placebo') =='1'? 'checked' : '' }}>
                      <label>yes</label>
                    </li>
                    <li>
                      <input type="radio" name="placebo" value="0" {{ old('placebo') =='0'? 'checked' : '' }}>
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
<!--               <div class="col-12 form-fields">
              <div class="d-inline-block"> -->
<!--               <div class="upload_files"> --><!-- <div class="yes "> -->
<!--     <span class="btn_upload"> -->
<!--       <input type="file" name="form_irb" id="imag" title="" class="input-img"/> -->
<!--             <span>Upload IRB approved Informed Consent Form (ICF)
              <input type="file" 
                    class="filepond"
                    name="form_irb"
                    accept="image/png, image/jpeg, image/gif"/>
              </span>
              <div class="error">*Upload the most recent and blank ICF</div> -->
<!--             </div> -->
           <div class="col-12 form-fields">
                <div class="d-inline-block">
        <label>Upload IRB approved Informed Consent Form (ICF)</label>
                      <input type="file" 
                    class="filepond"
                    name="form_irb"
                    accept="image/png, image/jpeg, image/gif"/>
      </div></div>
                <div class="error">*Upload the most recent and blank ICF</div>
              </div>
              <div class="col-12 text-center text-md-right">
                <a href="#" class="btn-typo" data-toggle="modal" data-target="#review-modal" id="submitBtn">SUBMIT</a>
                <input type="submit" value="submit" class="btn-typo" name=""  data-toggle="modal" data-target="#review-modal" style="display:none;">
              </div>
<!--           </div> -->
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
<!--             <h4>Clinical Study Synopsis</h4> -->
            <p>It is your responsibility to obtain permission from your IRB before listing a clinical study. Please visit the FDA guidance entitled, <a href="https://www.fda.gov/regulatory-information/search-fda-guidance-documents/recruiting-study-subjects" target="_blank">Recruiting Study Subjects – Information Sheet,</a>  which addresses IRB review and approval of clinical trials listings on the internet when the provided material goes beyond basic trial information, such as the title, purpose, protocol summary, basic eligibility criteria, locations and contact information. <a href="https://www.fda.gov/regulatory-information/search-fda-guidance-documents/recruiting-study-subjects" target="_blank">https://www.fda.gov/regulatory-information/search-fda-guidance-documents/recruiting-study-subjects</a></p>
          </div>
          <div class="addinital-info">
           <!--  <a href="#" class="javascript:void(0);">I AGREE</a> -->
           <button class="btn-typo agree-form">I AGREE
          </div>
            
        </div>
      </div>
    </div>
</div>

<div class="modal syposis-modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <ul>
                  <li><strong>Title:</strong><span id="title_study"></span></li>
                  <li><strong>Principal Investigator Name:</strong> <span id="name_private"></span></li>
                  <li><strong>Research Site Name:</strong><span id="name_site"></span></li>
                  <li><strong>Email:</strong><span id="email_show"></span></li>
                  <li><strong>Indication:</strong> Lorem Ipsum is simply dummy text.</li>
                  <li><strong>Objectives:</strong> Lorem Ipsum is simply dummy text.</li>
                  <li><strong>Phone:</strong> <span id="phone"></span></li>
                  <li><strong>Study Duration:</strong> 2 years</li>
                  <li><strong>Dose form and route of administration:</strong> Lorem Ipsum is simply dummy text.</li>
                  <li><strong>Efficacy Variables:</strong> Lorem Ipsum is simply dummy text.</li>
                  <li><strong>Pharmacokinetic Variables:</strong> Lorem Ipsum is simply dummy text.</li>
                  <li><strong>Pharmacodynamic Variables:</strong> Lorem Ipsum is simply dummy text.</li>
                  <li><strong>Safety Variables:</strong> Lorem Ipsum is simply dummy text.</li>
                  <li><strong>Sample Size Determination:</strong> Lorem Ipsum is simply dummy text.</li>
                </ul>
              </div>
              <div class="addinital-info">
                <a href="javascript:void(0);">ADD ADDITIONAL INFORMATION</a>
              </div>
            </div>
          </div>
        </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('#submitBtn').click(function() {
        $('#title_study').text($('#study_title').val());
        $('#name_private').text($('#private_name').val());
        $('#name_site').text($('#site_name').val());
        $('#phone').text($('#phone_no').val());
        $('#email_show').text($('#email').val());
        $('#fname').text($('.firstname').val());
   });
</script>

<script>
function show_condition(){
    $('#med_condition').show();
}
function hide_condition(){
    $('#med_condition').hide();
    $('#medical_condition').val('');
}
</script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var path = "{{ route('clinicalTrialManage.autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    }); 
</script>-->

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
            url: "{{ url('clinical-trial-manage/upload-irb')}}",
            process: {
                headers: {
                  'X-CSRF-TOKEN': csrf 
                },
            }
        }
    });
    const inputElement = document.querySelector('input[name="form_irb"]');
    const pond = FilePond.create( inputElement );
    </script>
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script type="text/javascript">
    var states = [];
//    console.log(states);
     jQuery.ajax({
        type: "GET",
        url: "{{ route('clinicalTrialManage.autocomplete') }}",
        success: function (response) {
            jQuery.each(response, function (i, str) {
                states.push(str);
            });
           console.log(states);
        }
    });
    console.log(states);
   var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

$('#medical_condition.typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});
</script>

<script>
$(document).ready(function(){
$(".agree-form").click(function(){
   $("#irb-form").trigger("submit");
});
});
</script>
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
  <script type="text/javascript">
  function readURL(input, imgControlName) {
  if (input.files && input.files[0]) {
      
  
    var reader = new FileReader();
    reader.onload = function(e) { console.log(input.files[0].type); console.log(input.files[0].name);
        if(input.files[0].type =="image/png"){
      $(imgControlName).attr('src', e.target.result);
      }else{ 
      $(imgControlName).attr('src', "http://clinicalmatch.com/images/pdf.png");
      }
    }
    reader.readAsDataURL(input.files[0]); }
  
}

$("#imag").change(function() {
  // add your logic to decide which image control you'll use
  var imgControlName = "#ImgPreview";
  readURL(this, imgControlName);
  $('.preview1').addClass('it');
  $('.btn-rmv1').addClass('rmv');
});
$("#removeImage1").click(function(e) {
  e.preventDefault();
  $("#imag").val("");
  $("#ImgPreview").attr("src", "");
  $('.preview1').removeClass('it');
  $('.btn-rmv1').removeClass('rmv');
});

// function readURL(input) {
  //if (input.files && input.files[0]) {
    //var reader = new FileReader();
    
    //reader.onload = function(e) {
      //$('#blah').attr('src', e.target.result);
    //}
    
    //reader.readAsDataURL(input.files[0]);
  //}
//}

//$("#imgInp").change(function() {
  //readURL(this);
//});
 </script>

 <script type="text/javascript">
        $(document).ready(function(){
         setTimeout(function(){ 
         var radioValue = $("input[name='vol_condition']:checked").val(); 
         console.log(radioValue);
         if(radioValue == "medical_condition")
         {
            $("input[name='vol_condition']:checked").click();
         } 
         });
      });
 </script>



@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script>
  $(function() {
    $('input[name="expiry_date"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      // autoUpdateInput: false, //disable default date
      minDate: moment(),
      minYear: 2020,
      maxYear: 2040,
    });
    $('input[name="expiry_date"]').val('MM-DD-YYYY');
  });
  </script>

<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.11/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript">
              $(document).ready(function () {
                    $('#phone_no').usPhoneFormat();
              });
</script>

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $('.expiry').datepicker({
        format: "dd-mm-yyyy"
  });
</script>
 -->
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

<!-- <script type="text/javascript">     
  var i = 0;
  $(document).ready(function(){            
  $("#add").click(function(){ 
      var valued = $("#medical_condition").val(); 
      console.log(valued); 
      var route_id = $("#medical_conditiond").val(valued);
      $("#medical_condition").val(''); 
      ++i;     
      $("#med_condition").append('<div class="custom-special"><input type="text" value="'+valued+'" name="addmore['+i+'][medical_condition]" placeholder="Enter your Medical Conditions" onkeypress="return isNumberKey(this, event);" class="typeahead form-control" id="medical_conditiond" /><button type="button" class="btn btn-danger remove-tr">Remove</button></div>');
      // $('.custom-special').remove();
  });
 
  $(document).on('click', '.remove-tr', function(){  
       $(this).parents('.custom-special').remove();
  });  
});
 
</script> -->

@endsection
