@extends('layouts.register-login')

@section('content')

<!-- <div class="container"> -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    @if(\Session::has('success'))

    <div class="alert alert-success">
        {{\Session::get('success')}}
    </div>
    
    @endif

    <section class="login-sec verify-sec">
        <div class="container">
            <form method="post" action="{{url('/create/profile')}}" enctype="multipart/form-data" id="profile-form">
                @csrf
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                <h4>Create your profile and customize your platform.</h4>
                <div class="profile-selector">
                    <h4>Who is this profile for?</h4>
                    <div class="post-sec login-main-fture profile-tab">
                        <div class="owl-carousel owl-theme owl-desktop-vw ">
                            @foreach($roles as $role)
                            <div class="item">
                                <div class="pro-tabbing">
                                    <?php $roled = $role->name; ?>
                                    <input type="radio" name="role" id="select_product" onclick="showTabs({{$role->id}});" class="role_class_<?php echo $role->id; ?>" value="<?php echo $role->id; ?>"
                                    <?php 
                                    if (isset($profile->role))
                                    {
                                          if($profile->role == $role->id || old('role') ==$role->id)
                                          {
                                                echo "checked";
                                          } 
                                    }
                                    ?>
                                    >
                                    <label>{{ $roled }}</label>
                                    <span class="tooltiptext">{{ $roled }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="login-create-form">
                    <div class="accordion" id="accordionExample">
                        <div class="card" id="personalinfo" style="display:none">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        User Information
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show {{ $errors->any() ? 'show' : '' }}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row" id="upload_image">
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="First Name*" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname',$profile->firstname ?? $user->firstname) }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Last Name*" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname',$profile->firstname ?? $user->lastname) }}">
                                        </div>
                                         <div class="col-12 col-md-6 login-form-fields">
                                          <input type="text" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email ?? '') }}" disabled="disabled">
                                        </div>
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Address Details*" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address',$profile->address ?? '') }}" autofocus>
                                        </div>
                                          @error('address')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        <div class="col-12 col-md-12 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Contact Number*" onkeypress="return isNumberKey(this, event);" maxlength="10" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact',$profile->contact ?? '') }}" >
                                        </div>
                                        <div class="col-12 login-form-fields">
<!--                                             <div class="upload_files"> -->
                                                <span>Upload Profile Image: <input type="file" 
                                                                              class="filepond"
                                                                              name="image"
                                                                              accept="image/png, image/jpeg, image/gif"/>
                                                </span> 
                                                <br>    
<!--                                             </div> -->
                                        </div>
   <!--                                      <div class="image-details" id="image-details">
                                        <img id="blah" hspace="10" height="150" width="200" style="display:none"/>
                                        <label id="file-name"></label>
                                        <br>
                                        <button type="button" class="btn btn-danger remove-image" id="remove_image" style="display:none">Remove</button>
                                       </div> -->
                                     </div>   
                                </div>
                            </div>
                        </div>

                        <div class="card" id="patientinfo" style="display:none">
                            <div class="card-header" id="headingTwo" >
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Patient Information
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseTwo" class="collapse {{ $errors->any() ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 login-form-fields">
                                           <input type="text" placeholder="First Name*" value="{{ old('patient_first',$profile->patient_first ?? '') }}" name="patient_first" class="form-control @error('patient_first') is-invalid @enderror">
                                            <span>First Name of the person that needs a clinical trial</span>
                                        </div>
                                        @error('patient_first')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Last Name*" class="form-control @error('patient_last') is-invalid @enderror" name="patient_last" value="{{ old('patient_last',$profile->patient_last ?? '') }}">
                                        </div>
                                        @error('patient_last')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                           <input type="text" placeholder="Physician Name*" value="{{ old('patient_phy__name',$profile->patient_phy__name ?? '') }}" name="patient_phy__name" class="form-control @error('patient_phy__name') is-invalid @enderror">
                                        </div>
                                        @error('patient_phy__name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Physician Email*" class="form-control @error('patient_phy__email') is-invalid @enderror" name="patient_phy__email" value="{{ old('patient_phy__email',$profile->patient_phy__email ?? '') }}">
                                        </div>
                                        @error('patient_phy__email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                           <input type="text" maxlength="10" placeholder="Physician Phone*" maxlength="10" onkeypress="return isNumberKey(this, event);" value="{{ old('patient_phy__phone',$profile->patient_phy__phone ?? '') }}" name="patient_phy__phone" class="form-control @error('patient_phy__phone') is-invalid @enderror">
                                        </div>
                                        @error('patient_phy__phone')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Caregiver Name*" class="form-control @error('care_giver_name') is-invalid @enderror" name="care_giver_name" value="{{ old('care_giver_name',$profile->care_giver_name ?? '') }}">
                                        </div>
                                        @error('care_giver_name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                           <input type="text" placeholder="Caregiver Email*" value="{{ old('care_giver_email',$profile->care_giver_email ?? '') }}" name="care_giver_email" class="form-control @error('care_giver_email') is-invalid @enderror">
                                        </div>
                                        @error('care_giver_email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Caregiver Phone*" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control @error('care_giver_phone') is-invalid @enderror" name="care_giver_phone" value="{{ old('care_giver_phone',$profile->care_giver_phone ?? '') }}">
                                        </div>
                                        @error('care_giver_phone')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text"  placeholder="MM-DD-YYYY" class="date form-control  @error('patient_date') is-invalid @enderror" name="patient_date" value="{{ old('patient_date',$profile->patient_date ?? '') }}">
                                        </div>
                                        @error('patient_date')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 form-fields">
                                        <div class="radio-selector">
                                                 <ul>
                                                  <li>
                                                    <input type="radio" name="medical_status" value="0" {{{ (isset($profile->medical_status) && $profile->medical_status == '0') ? "checked" : (old('medical_status') == '0') ? 'checked' : '' }}}>
                                                    <label>I am volunteering for a clinical study</label>
                                                  </li>
                                                  <li>
                                                    <input type="radio" name="medical_status" value="1" {{{ (isset($profile->medical_status) && $profile->medical_status == '1') ? "checked" : (old('medical_status') == '1') ? 'checked' : '' }}}>
                                                    <label>I have a medical condition</label>
                                                  </li>
                                                </ul>
                                                </div>
                                          @error('medical_status')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
                                        <div class="col-12 col-md-8 login-form-fields" id="upload_file" style="display:none">
                                            <div class="upload-file">
                                              <div class="upload_files">
                                                <span>Click here to upload your medical records <input type="file" placeholder="Click here to upload your medical records" name="file_name[]" multiple>
                                                </span> 
                                              </div>
                                            </div>
                                            <span>Volunteers don’t have to upload medical records</span>
                                        </div>
                                        @error('medical_status')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
<!--                                         <div class="col-12 col-md-4 form-fields" id="upload_medical" style="display:none">
                                            <div class="upload-btn text-right">
                                                <a href="#">Upload</a>
                                            </div>
                                        </div> -->
                                         <div class="col-12 col-md-6 login-form-fields">
                                          <div class="select-box" >
                                            <select name="sex_info">
                                              <option selected="selected" disabled>--Gender--</option> 
                                              <option {{{ (isset($profile->sex_info) && $profile->sex_info == 'Male') ? "selected=\"selected\"" : (old('sex_info') == 'Male') ? 'selected' : '' }}}>Male</option>
                                               <option {{{ (isset($profile->sex_info) && $profile->sex_info == 'Female') ? "selected=\"selected\"" : (old('sex_info') == 'Female') ? 'selected' : '' }}}>Female</option>
                                              <option {{{ (isset($profile->sex_info) && $profile->sex_info == 'Other') ? "selected=\"selected\"" : (old('sex_info') == 'Other') ? 'selected' : '' }}}>Other</option>
                                            </select>
                                          </div>
                                          @error('sex_info')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                          <div class="select-box" >
                                            <select name="ethnicity_info">
                                              <option selected="selected" disabled>--Ethnicity--</option> 
                                              <option {{{ (isset($profile->ethnicity_info) && $profile->ethnicity_info == 'hispanic') ? "selected=\"selected\"" : (old('ethnicity_info') == 'hispanic') ? 'selected' : '' }}} value="hispanic" >Hispanic</option>
                                              <option  {{{ (isset($profile->ethnicity_info) && $profile->ethnicity_info == 'nonhispanic') ? "selected=\"selected\"" : (old('ethnicity_info') == 'nonhispanic') ? 'selected' : '' }}} value="nonhispanic">Non-Hispanic</option>
                                            </select>
                                          </div>
                                          @error('ethnicity_info')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Race*" class="form-control @error('race_info') is-invalid @enderror" name="race_info" value="{{ old('race_info',$profile->race_info ?? '') }}" autofocus>
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Preferred Language of Communication*" class="form-control @error('preferred_lang') is-invalid @enderror" name="preferred_lang" value="{{ old('preferred_lang',$profile->preferred_lang ?? '') }}" autofocus>
                                        </div>
                                        @error('preferred_lang')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                        @enderror
<!--                                         <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Education*" class="form-control @error('education_info') is-invalid @enderror" name="education_info" value="{{ old('education_info',$profile->education_info ?? '') }}" autofocus>
                                        </div>
                                        @error('education_info')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Occupation*" class="form-control @error('occupation_info') is-invalid @enderror" name="occupation_info" value="{{ old('occupation_info',$profile->occupation_info ?? '') }}" autofocus>
                                        </div>
                                        @error('occupation_info')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                        @enderror
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Income*" onkeypress="return isNumberKey(this, event);" class="form-control @error('income_info') is-invalid @enderror" name="income_info" value="{{ old('income_info',$profile->income_info ?? '') }}" >
                                        </div>
                                        @error('income_info')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                        @enderror -->

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card" id="companyinfo" style="display:none">
                            <div class="card-header" id="headingThree" >
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Professional Information
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse {{ $errors->any() ? 'show' : '' }}" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                     <div class="row">
                                        <div class="col-12 col-md-12 login-form-fields">
                                            <input id="job_title_info" type="text" placeholder="Job Title*" class="form-control @error('job_title_info') is-invalid @enderror" name="job_title_info" value="{{ old('job_title_info',$profile->job_title_info ?? '') }}" autofocus>
                                        </div>
                                     </div>  
                                    <div class="row role-prinicipal-investigators">
                                        <div class="col-12 col-md-6 login-form-fields" id="specialdynamic">
                                            <input type="text" placeholder="Specialty*" name="addmore[0][principal_specialty]" autofocus>
                                        </div>
                                        <div class="upload_files">
                                        <span><button type="button" name="add" id="add">Add More Specialties</button></span>
                                       </div>
                                        <div class="col-12 col-md-6 login-form-fields" id="subspecialdynamic">
                                            <input type="text" placeholder="Sub Specialty*" name="addmoresubs[0][principal_sub_specialty]" autofocus>
                                        </div>
                                        <div class="upload_files">
                                        <span><button type="button" name="add_sub" id="add_sub">Add More Sub Specialties</button></span>
                                       </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="14" placeholder="Medical License Number*" onkeypress="return isNumberKey(this, event);" class="form-control @error('principal_medical_license') is-invalid @enderror" name="principal_medical_license" value="{{ old('principal_medical_license',$profile->principal_medical_license ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Medical License State*" class="form-control @error('principal_medical_state') is-invalid @enderror" name="principal_medical_state" value="{{ old('principal_medical_state',$profile->principal_medical_state ?? '') }}" autofocus>
                                        </div>

                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="2" placeholder="Years of clinical research Experience*" onkeypress="return isNumberKey(this, event);" class="form-control @error('principal_research_experience') is-invalid @enderror" name="principal_research_experience" value="{{ old('principal_research_experience',$profile->principal_research_experience ?? '') }}" >
                                        </div>
                                        <div class="col-12 login-form-fields">
                                         <textarea  class="form-control @error('principal_therapeutic') is-invalid @enderror" name="principal_therapeutic" placeholder="Therapeutic areas of clinical research experience *">{{ old('principal_therapeutic',$profile->principal_therapeutic ?? '') }}</textarea>
                                        </div>
                                        <div class="col-12 login-form-fields">
                                                <label>Will you be accepting sub-investigators ?</label>
                                                <div class="radio-selector">
                                                <ul>
                                                  <li>
                                                    <input type="radio" name="principal_sub" value="1" {{{ (isset($profile->principal_sub) && $profile->principal_sub == '1') ? "checked" : (old('principal_sub') == '1') ? 'checked' : '' }}}>
                                                    <label>Yes</label>
                                                  </li>
                                                  <li>
                                                    <input type="radio" name="principal_sub" value="0" {{{ (isset($profile->principal_sub) && $profile->principal_sub == '0') ? "checked" : (old('principal_sub') == '0') ? 'checked' : '' }}}>
                                                    <label>No</label>
                                                  </li>
                                                </ul>
                                                </div>
                                          @error('principal_sub')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
                                        <div class="col-12 col-md-12 login-form-fields">
<!--                                           <div class="upload_files"> -->
<!--                                             <span>Upload CV: <input type="file" name="principal_cv" id="imgprincipalcv"></span> -->
                                                <span>Upload CV: <input type="file" 
                                                                              class="filepond"
                                                                              name="principal_cv"
                                                                              accept="image/png, image/jpeg, image/gif"/>
                                                </span> 
<!--                                           </div> -->
                                        </div>
<!--                                         <img id="blah_principal_cv" hspace="10" height="150" width="200" style = "display:none"/>
                                        <label id="file-name"></label> -->
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Research site name*" class="form-control @error('principal_site_name') is-invalid @enderror" name="principal_site_name" value="{{ old('principal_site_name',$profile->principal_site_name ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Research site address*" class="form-control @error('principal_site_address') is-invalid @enderror" name="principal_site_address" value="{{ old('principal_site_address',$profile->principal_site_address ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Research site telephone*" onkeypress="return isNumberKey(this, event);" maxlength="10"  class="form-control @error('principal_site_telephone') is-invalid @enderror" name="principal_site_telephone" value="{{ old('principal_site_telephone',$profile->principal_site_telephone ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="7" placeholder="Research site fax*" class="form-control @error('principal_fax') is-invalid @enderror" name="principal_fax" value="{{ old('principal_fax',$profile->principal_fax ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Name of contact person at research site*" class="form-control @error('principal_person_company') is-invalid @enderror" name="principal_person_company" value="{{ old('principal_person_company',$profile->principal_person_company ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Email of contact person at research site*" class="form-control @error('principal_email') is-invalid @enderror" name="principal_email" value="{{ old('principal_email',$profile->principal_email ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Telephone of contact person at research site*" onkeypress="return isNumberKey(this, event);" class="form-control @error('principal_telephone') is-invalid @enderror" maxlength="10" name="principal_telephone" value="{{ old('principal_telephone',$profile->principal_telephone ?? '') }}" >
                                        </div>
                                    </div>
                                    <div class="row role-research-coordinators" >
                                        <div class="col-12 col-md-12 login-form-fields">
                                            <input type="text" placeholder="Company name*" class="form-control @error('research_company') is-invalid @enderror" name="research_company" value="{{ old('research_company',$profile->research_company ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-12 login-form-fields">
                                            <textarea  class="form-control @error('research_brief') is-invalid @enderror" name="research_brief" placeholder="Briefly introduce your company">{{ old('research_brief',$profile->research_brief ?? '') }}</textarea>
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Name of contact person at company*" class="form-control @error('research_per_name') is-invalid @enderror" name="research_per_name" value="{{ old('research_per_name',$profile->research_per_name ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Contact person telephone*" onkeypress="return isNumberKey(this, event);" maxlength="10" class="form-control @error('research_per_tele') is-invalid @enderror" name="research_per_tele" value="{{ old('research_per_tele',$profile->research_per_tele ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Contact person email*" class="form-control @error('research_per_email') is-invalid @enderror" name="research_per_email" value="{{ old('research_per_email',$profile->research_per_email ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Company contact address*" class="form-control @error('research_per_address') is-invalid @enderror" name="research_per_address" value="{{ old('research_per_address',$profile->research_per_address ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Company contact telephone*" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control @error('research_comp_tele') is-invalid @enderror" name="research_comp_tele" value="{{ old('research_comp_tele',$profile->research_comp_tele ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="7" placeholder="Company contact fax*" class="form-control @error('research_comp_fax') is-invalid @enderror" name="research_comp_fax" value="{{ old('research_comp_fax',$profile->research_comp_fax ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-12 login-form-fields role-pharmaceutical-company">
                                            <textarea  class="form-control @error('research_therapeutic') is-invalid @enderror" name="research_therapeutic" placeholder="Therapeutic areas of drug development*">{{ old('research_therapeutic',$profile->research_therapeutic ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row role-sponsors" >
                                        <div class="col-12 col-md-12 login-form-fields">
                                            <input type="text" placeholder="Company name*" class="form-control @error('sponsor_company') is-invalid @enderror" name="sponsor_company" value="{{ old('sponsor_company',$profile->sponsor_company ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-12 login-form-fields">
                                            <textarea  class="form-control @error('sponsor_brief') is-invalid @enderror" name="sponsor_brief" placeholder="Briefly introduce your company">{{ old('sponsor_brief',$profile->sponsor_brief ?? '') }}</textarea>
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Name of contact person at company*" class="form-control @error('sponsor_per_name') is-invalid @enderror" name="sponsor_per_name" value="{{ old('sponsor_per_name',$profile->sponsor_per_name ?? '') }}" >
                                        </div>
                                         <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Contact person telephone*" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control @error('sponsor_per_tele') is-invalid @enderror" name="sponsor_per_tele" value="{{ old('sponsor_per_tele',$profile->sponsor_per_tele ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Contact person email*" class="form-control @error('sponsor_per_email') is-invalid @enderror" name="sponsor_per_email" value="{{ old('sponsor_per_email',$profile->sponsor_per_email ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Company contact address*" class="form-control @error('sponsor_per_address') is-invalid @enderror" name="sponsor_per_address" value="{{ old('sponsor_per_address',$profile->sponsor_per_address ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Company contact telephone*" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control @error('sponsor_comp_tele') is-invalid @enderror" name="sponsor_comp_tele" value="{{ old('sponsor_comp_tele',$profile->sponsor_comp_tele ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="7" placeholder="Company contact fax*" class="form-control @error('sponsor_comp_fax') is-invalid @enderror" name="sponsor_comp_fax" value="{{ old('sponsor_comp_fax',$profile->sponsor_comp_fax ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <textarea  class="form-control @error('sponsor_therapeutic') is-invalid @enderror" name="sponsor_therapeutic" placeholder="Therapeutic areas of drug development*">{{ old('sponsor_therapeutic',$profile->sponsor_therapeutic ?? '') }}</textarea>
                                        </div>
                                      </div>
                                        <div class="row role-physicians">
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Specialty*" class="form-control @error('physician_specialty') is-invalid @enderror" name="physician_specialty" value="{{ old('physician_specialty',$profile->physician_specialty ?? '') }}" autofocus>
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Sub Specialty*" class="form-control @error('physician_sub_specialty') is-invalid @enderror" name="physician_sub_specialty" value="{{ old('physician_sub_specialty',$profile->physician_sub_specialty ?? '') }}" autofocus>
                                        </div>
<!--                                         <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Medical License Number*" onkeypress="return isNumberKey(this, event);" class="form-control @error('physician_medical_license') is-invalid @enderror" name="physician_medical_license" value="{{ old('physician_medical_license',$profile->physician_medical_license ?? '') }}" >
                                        </div> -->
                                        <div class="col-12 col-md-6 login-form-fields" id="specialdynamic_medical">
                                            <input type="text" maxlength="10" placeholder="Medical License Number*" onkeypress="return isNumberKey(this, event);"  name="addmedicallicenses[0][physician_medical_license]" autofocus>
                                        </div>
                                        <div class="col-12 col-md-6 upload_files">
                                        <span><button type="button" name="add_medical" id="add_medical">Add More Medical License Number</button></span>
                                       </div>
<!--                                         <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Medical License State*" class="form-control @error('physician_medical_state') is-invalid @enderror" name="physician_medical_state" value="{{ old('physician_medical_state',$profile->physician_medical_state ?? '') }}" autofocus>
                                        </div> -->
                                       <div class="col-12 col-md-6 login-form-fields" id="specialdynamic_medicalstate">
                                            <input type="text" placeholder="Medical License State*" name="addmedicalstates[0][physician_medical_state]" autofocus>
                                        </div>
                                        <div class="col-12 col-md-6 upload_files">
                                        <span><button type="button" name="add_states" id="add_states">Add More Medical License States</button></span>
                                       </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                          <label>Do you have clinical research experience?</label>
                                          <div class="radio-selector">
                                              <ul>
                                                <li>
                                                  <input type="radio" name="physician_research" onclick="show1();"  value="1" {{{ (isset($profile->physician_research) && $profile->physician_research == '1') ? "checked" : (old('physician_research') == '1') ? 'checked' : '' }}}>
                                                  <label>Yes</label>
                                                </li>
                                                <li>
                                                  <input type="radio" name="physician_research" onclick="show2();" value="0" {{{ (isset($profile->physician_research) && $profile->physician_research == '0') ? "checked" : (old('physician_research') == '0') ? 'checked' : '' }}}>
                                                  <label>No</label>
                                                </li>
                                              </ul>
                                          </div>
                                          <div class="col-12 col-md-12 login-form-fields" id="div1" style="display:none">
                                              <input type="text" placeholder="Years of clinical research information*" onkeypress="return isNumberKey(this, event);" class="form-control @error('physician_research_experience') is-invalid @enderror" name="physician_research_experience" value="{{ old('physician_research_experience',$profile->physician_research_experience ?? '') }}" >
                                          </div>
                                          @error('physician_research')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
<!--                                         <div class="col-12 login-form-fields">
                                         <textarea  class="form-control @error('physician_therapeutic') is-invalid @enderror" name="physician_therapeutic" placeholder="Therapeutic areas of drug development*">{{ old('physician_therapeutic',$profile->physician_therapeutic ?? '') }}</textarea>
                                        </div> -->
                                        <div class="col-12 col-md-6  login-form-fields">
                                                <label>Are You Interested in Becoming a Sub-Investigator?</label>
                                                <div class="radio-selector">
                                                <ul>
                                                  <li>
                                                    <input type="radio" name="physician_sub" value="1" {{{ (isset($profile->physician_sub) && $profile->physician_sub == '1') ? "checked" : (old('physician_sub') == '1') ? 'checked' : '' }}}>
                                                    <label>Yes</label>
                                                  </li>
                                                  <li>
                                                    <input type="radio" name="physician_sub" value="0" {{{ (isset($profile->physician_sub) && $profile->physician_sub == '0') ? "checked" : (old('physician_sub') == '0') ? 'checked' : '' }}}>
                                                    <label>No</label>
                                                  </li>
                                                </ul>
                                                </div>
                                          @error('physician_sub')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
                                        <div class="col-12 col-md-12 login-form-fields">
                                          <div class="upload_files">
<!--                                             <span>Upload CV: <input type="file" name="physician_cv" id="imgcv"></span> -->
                                            <span>Upload CV: <input type="file" 
                                              class="filepond"
                                              name="physician_cv"
                                              accept="image/png, image/jpeg, image/gif"/>
                                          </div>
                                        </div>
<!--                                         <img id="blah_cv" hspace="10" height="150" width="200" style = "display:none"/>
                                        <label id="file-name"></label> -->
                                        <br>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Clinic Name*" class="form-control @error('physician_clinic_info') is-invalid @enderror" name="physician_clinic_info" value="{{ old('physician_clinic_info',$profile->physician_clinic_info ?? '') }}" >
                                        </div>
                                         <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Clinic Address*" class="form-con @error('physician_clinic_address') is-invalid @enderror" name="physician_clinic_address" value="{{ old('physician_clinic_address',$profile->physician_clinic_address ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Clinic Telephone*" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control @error('physician_clinic_tele') is-invalid @enderror" name="physician_clinic_tele" value="{{ old('physician_clinic_tele',$profile->physician_clinic_tele ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Clinic Fax*" class="form-control @error('physician_clinic_fax') is-invalid @enderror" name="physician_clinic_fax" value="{{ old('physician_clinic_fax',$profile->physician_clinic_fax ?? '') }}" >
                                        </div>
                                        <div class="col-12 login-form-fields">
                                                <label>Type of Medical Record Storage ?</label>
                                                <div class="radio-selector">
                                                <ul>
                                                  <li>
                                                    <input type="radio" name="physician_record_storage" value="electronic" {{{ (isset($profile->physician_record_storage) && $profile->physician_record_storage == 'electronic') ? "checked" : (old('physician_record_storage') == 'electronic') ? 'checked' : '' }}}>
                                                    <label>Electronic</label>
                                                  </li>
                                                  <li>
                                                    <input type="radio" name="physician_record_storage" value="paper" {{{ (isset($profile->physician_record_storage) && $profile->physician_record_storage == 'paper') ? "checked" : (old('physician_record_storage') == 'paper') ? 'checked' : '' }}}>
                                                    <label>Paper</label>
                                                  </li>
                                                </ul>
                                                </div>
                                          @error('physician_record_storage')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Name of contact person at clinic*" class="form-control @error('clinic_person_contact') is-invalid @enderror" name="clinic_person_contact" value="{{ old('clinic_person_contact',$profile->clinic_person_contact ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Email of contact person at clinic*" class="form-control @error('clinic_person_email') is-invalid @enderror" name="clinic_person_email" value="{{ old('clinic_person_email',$profile->clinic_person_email ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" maxlength="10" placeholder="Telephone of contact person at clinic*" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control @error('clinic_person_telephone') is-invalid @enderror" name="clinic_person_telephone" value="{{ old('clinic_person_telephone',$profile->clinic_person_telephone ?? '') }}" >
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Size of Patient Database*" class="form-control @error('clinic_database') is-invalid @enderror" name="clinic_database" value="{{ old('clinic_database',$profile->clinic_database ?? '') }}" >
                                        </div>
                                        <div class="col-12 login-form-fields">
                                                <label>Type of Medical Establishment ?</label>
                                                <div class="radio-selector">
                                                <ul>
                                                  <li>
                                                   <input type="radio" name="med_est_type" value="1" onclick="other2();" {{{ (isset($profile->med_est_type) && $profile->med_est_type == '1') ? "checked" : (old('med_est_type') == '1') ? 'checked' : '' }}}>
                                                    <label>Academic Institution</label>
                                                  </li>
                                                  <li>
                                                    <input type="radio" name="med_est_type" value="2" onclick="other2();" {{{ (isset($profile->med_est_type) && $profile->med_est_type == '2') ? "checked" : (old('med_est_type') == '2') ? 'checked' : '' }}}>
                                                    <label>Sole Provider private clinic</label>
                                                  </li>
                                                  <li>
                                                    <input type="radio" name="med_est_type" value="3" onclick="other2();" {{{ (isset($profile->med_est_type) && $profile->med_est_type == '3') ? "checked" : (old('med_est_type') == '3') ? 'checked' : '' }}}>
                                                    <label>Multiple-Provider private clinic</label>
                                                  </li>
                                                  <li>
                                                    <input type="radio" name="med_est_type" value="4" onclick="other1();" {{{ (isset($profile->med_est_type) && $profile->med_est_type == '4') ? "checked" : (old('med_est_type') == '4') ? 'checked' : '' }}}>
                                                    <label>Other</label>
                                                  </li>
                                                </ul>
                                                </div>
                                          @error('med_est_type')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                        </div>
                                        <div class="col-12 col-md-12 login-form-fields" id="other-name" style="display:none">
                                                    <input type="text" placeholder="Name of Medical Establishment*" class="form-control @error('other_name') is-invalid @enderror" name="other_name" value="{{ old('other_name',$profile->other_name ?? '') }}" >
                                                </div>
                                          @error('other_name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                          @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
<!--                         <div class="card" id="paymentinfo" style="display:none">
                            <div class="card-header" id="headingThree" >
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Payment Information
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse {{ $errors->any() ? 'show' : '' }}" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Credit Card Information*" class="form-control @error('credit_card_info') is-invalid @enderror" name="credit_card_info" value="{{ old('credit_card_info',$profile->credit_card_info ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="ACH Details*" class="form-control @error('ach_info') is-invalid @enderror" name="ach_info" value="{{ old('ach_info',$profile->ach_info ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
<!--                         <div class="card" id="bankinfo" style="display:none">
                            <div class="card-header" id="headingThree" >
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Banking Information
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse {{ $errors->any() ? 'show' : '' }}" aria-labelledby="headingFive" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Bank Name*" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ old('bank_name',$profile->bank_name ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Account Number*" onkeypress="return isNumberKey(this, event);" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number',$profile->account_number ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Routing Number*" onkeypress="return isNumberKey(this, event);" class="form-control @error('routing_number') is-invalid @enderror" name="routing_number" value="{{ old('routing_number',$profile->routing_number ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card" id="nonprofit" style="display:none">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Non-Profit Information

                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse {{ $errors->any() ? 'show' : '' }}" aria-labelledby="headingSix" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Charity Name*" class="form-control @error('name_charity') is-invalid @enderror" name="name_charity" value="{{ old('name_charity',$profile->name_charity ?? '') }}">
                                        </div>
                                        <div class="col-12 col-md-6 login-form-fields">
                                            <input type="text" placeholder="Charity Address*" class="form-control @error('address_charity') is-invalid @enderror" name="address_charity" value="{{ old('address_charity',$profile->address_charity ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="reset-pass text-center">
                        @if(empty( Auth::user()->provider))
                        <a href="{{ route('profile.change')}}">Reset password</a>
                        @endif
                    </div>
                    <div class="upload-btn text-center my-5" id="complete_profile" style="display:none">
                       <!--  <a href="{{ route('profile.skip',['id'=> $role->id]) }}" class="btn-typo" onclick="return theFunction();" >SKIP AND CONTINUE</a> -->
                        <a href="{{ route('profile.skip',['id'=> $role->id]) }}" class="btn-typo" onclick="skip();return false;" >SKIP AND CONTINUE</a>
                        <input type="submit" value="COMPLETE"  data-toggle="modal" data-target="#exampleModalCenter" id="submitBtn" class="btn-typo">
<!--                         <a href="#" class="btn-typo" data-toggle="modal" data-target="#exampleModalCenter" id="submitBtn">COMPLETE</a>
                        <input type="submit" value="COMPLETE"  data-toggle="modal" data-target="#exampleModalCenter" id="submitBtn" class="btn-typo" style="display:none;"> -->
                    </div>
                    <div class="all-secure text-center" id="secure_info" style="display:none">
                        <img src="{{ asset('images/all-secure.png') }}">
                        <span>All of your information is secure.</span>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                  url: "{{ url('account/personal/upload')}}",
                  process: {
                      headers: {
                        'X-CSRF-TOKEN': csrf 
                      },
                  }
              }
          });
          const inputElement = document.querySelector('input[name="image"]');
          const inputElementphy = document.querySelector('input[name="physician_cv"]');
          const inputElementprin = document.querySelector('input[name="principal_cv"]');
          const pond = FilePond.create( inputElement);
          const pond_cv = FilePond.create( inputElementphy);
          const pond_prin_cv = FilePond.create( inputElementprin);
          </script>

<!--           <script>
          FilePond.registerPlugin();
          var elementpri= document.querySelector('meta[name="csrf-token"]');
          var csrf = elementpri && elementpri.getAttribute("content");
          FilePond.setOptions({
            server: {
                  url: "{{ url('account/professional/upload-principal')}}",
                  process: {
                      headers: {
                        'X-CSRF-TOKEN': csrf 
                      },
                  }
              }
          });
          const inputElementcv = document.querySelector('input[name="principal_cv"]');
          const pond_cv = FilePond.create( inputElementcv );
          </script> -->

<!--           <script>
          FilePond.registerPlugin();
          var elementphy = document.querySelector('meta[name="csrf-token"]');
          consolee.log()
          var csrf = elementphy && elementphy.getAttribute("content");
          FilePond.setOptions({
            server: {
                  url: "{{ url('account/professional/upload-physician')}}",
                  process: {
                      headers: {
                        'X-CSRF-TOKEN': csrf 
                      },
                  }
              }
          });
          const inputElementcvphy = document.querySelector('input[name="physician_cv"]');
          const pond_cv_phy = FilePond.create( inputElementcvphy );
          </script> -->
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
            function skip() 
            {
                 var role = $("input[name='role']:checked").val();
                 window.location = "{{ url('/') }}/profile/skip?id="+ role;
            }

            function showTabs(role){

            $(this).prop('checked', true);
            $('#patientinfo, #companyinfo, #paymentinfo, #bankinfo, #nonprofit','#personalinfo').slideDown();
            // $('#patientinfo, #companyinfo, #paymentinfo, #bankinfo, #nonprofit').hide();
            $('.role-research-coordinators,.role-prinicipal-investigators, .role-pharmaceutical-company, .role-sponsors,.role-patients,.role-physicians').hide();
            // Role Physicians
            if (role == 2){
            $('#paymentinfo').slideUp();
            $('#personalinfo,#companyinfo,#bankinfo,#nonprofit,#complete_profile,#secure_info').slideDown();
            $('#patientinfo').hide();
            $('.role-physicians').show();
            }
            // Role Patients & Volunteers
            else if (role == 3){
            $('#companyinfo, #paymentinfo').slideUp();
            $('#personalinfo,#patientinfo,#bankinfo,#nonprofit,#complete_profile,#secure_info').slideDown();
            $('.role-patients').show();
            }
            // Role Family & Friends of Patients
            else if (role == 4){
            $('#companyinfo,#paymentinfo').slideUp();
            $('#personalinfo,#patientinfo,#bankinfo,#nonprofit,#complete_profile,#secure_info').slideDown();
            $('.role-patients').show();
            }
            // Role Sponsors
            else if (role == 5){
            $('#patientinfo,#bankinfo,#nonprofit').slideUp();
            $('#personalinfo,#companyinfo,#paymentinfo,#complete_profile,#secure_info').slideDown();
            $('.role-sponsors').show();
            }
            // Role Prinicipal Investigators
            else if (role == 6){
            $('#patientinfo,#bankinfo,#nonprofit').slideUp();
            $('#personalinfo,#companyinfo,#paymentinfo,#complete_profile,#secure_info').slideDown();
            $('.role-prinicipal-investigators').show();
            }
            // Role Research Coordinators
            else if (role == 7){
            $('#patientinfo,#bankinfo,#nonprofit').slideUp();
            $('#personalinfo,#companyinfo,#paymentinfo,#complete_profile,#secure_info').slideDown();
            $('.role-research-coordinators').show();
            }
//            
            }
            function show1(){
              $('#div1').show();
            }
            function show2(){
              $('#div1').hide();
            }
            function other1(){
              $('#other-name').show();
            }
            function other2(){
              $('#other-name').hide();
            }
            // function show_medical(){
            //   $('#upload_file').show();
            // }
            // function hide_medical(){
            //   $('#upload_file').hide();
            // }
            $(document).ready(function(){
               setTimeout(function(){ 
               var radioValue = $("input[name='role']:checked").val(); 
               $(".role_class_"+radioValue).trigger("click");
               $(".role_class_"+radioValue).addClass("thisone"); 
               });
            });

            $(document).ready(function(){
              $("input[name=\"medical_status\"]").click(function(){
                var thisElem = $(this);
                var value = thisElem.val();
                // alert(value);
                if(value == 1)
                {
                  $("#upload_file").show();
                }
                else
                {
                  $("#upload_file").hide();
                }  
                $("."+value).show();
                localStorage.setItem("option", value);
                });
              var itemValue = localStorage.getItem("option");
              if (itemValue !== null) {
                $("input[value=\""+itemValue+"\"]").click();
              }
            });
            // $(document).ready(function(){
            // $(".agree-form").click(function(){
            //    $("#profile-form").trigger("submit");
            // });
            // });
        </script>
          <script type="text/javascript">
          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();       
              reader.onload = function(e) {
                $('#blah').css('display', 'block');
                $('#remove_image').css('display', 'block');
                $('#blah').attr('src', e.target.result);
              }  
              reader.readAsDataURL(input.files[0]);
            }
          }

          // function readURL(input) {
          //     var url = input.value;
          //     var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
          //     if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "pdf")) {
          //         var reader = new FileReader();

          //         reader.onload = function (e) {
          //             $('.blah').attr('src', e.target.result);
          //         }

          //         reader.readAsDataURL(input.files[0]);
          //     }else{
          //          $('.blah').attr('src', '/assets/no_preview.png');
          //     }
          // }
          $("#imgInp").change(function() {
            readURL(this);
          });
          </script> 

          <script type="text/javascript">
            function readURLCV(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function(e) {
                $('#blah_cv').css('display', 'block');
                $('#blah_cv').attr('src', e.target.result);
              }  
              reader.readAsDataURL(input.files[0]);
            }
          }
          $("#imgcv").change(function() {
            readURLCV(this);
          });
          </script>  

          <script type="text/javascript">
            function readURLPrincipalCV(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function(e) {
                $('#blah_principal_cv').css('display', 'block');
                $('#blah_principal_cv').attr('src', e.target.result);
              }  
              reader.readAsDataURL(input.files[0]);
            }
          }
          $("#imgprincipalcv").change(function() {
            readURLPrincipalCV(this);
          });
          </script>  

          <script type="text/javascript">     
              $(document).ready(function(){            
              $(document).on('click', '#remove_image', function(){  
                   $(this).parents('.image-details').remove();
                   $("#upload_image").append('<div class="image-details" id="image-details"><img id="blah" hspace="10" height="150" width="200" style = "display:none"/><label id="file-name"></label><br><button type="button" class="btn btn-danger remove-image" id="remove_image" style="display:none">Remove</button></div>');
                   $("#imgInp").val('');
                   $("#blah").val('');
              });  
            });
             
          </script>
    </section>
<!--     <div class="modal syposis-modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  <h4>Terms and Conditions</h4>
                  <p>By using Clinical Match, you agree to abide by the following</p>
                  <ul>
                    <li> All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Int</li>
                    <li>expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do no</li>
                    <li>turi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilise</li>
                    <li>every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will fr</li>
                    <li>nce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire</li>
                  </ul>
                </div>
                <div class="addinital-info">
                   <button class="btn-typo agree-form">AGREE</a>
                </div>
              </div>
            </div>
          </div>
  </div> -->
    @endsection
      @section('scripts')
<!--           <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
          <script type="text/javascript">
            $('.date').datepicker({  
                  format: "dd-mm-yyyy",
                  endDate: '-1d'
            });  
          </script>  -->
            <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
      <script>
      $(function() {
        $('input[name="patient_date"]').daterangepicker({
          singleDatePicker: true,
          autoUpdateInput: false, //disable default date
          showDropdowns: true,
          minYear: 1901,
          maxYear: parseInt(moment().format('YYYY'),10),
        });
        $('input[name="patient_date"]').val('MM-DD-YYYY');
      });
      </script>

      <script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.11/dist/jquery-input-mask-phone-number.js"></script>
      <script type="text/javascript">
                    $(document).ready(function () {
                          $('input[name="contact"],input[name="patient_phy__phone"],input[name="care_giver_phone"],input[name="physician_clinic_tele"],input[name="clinic_person_telephone"],input[name="sponsor_per_tele"],input[name="sponsor_comp_tele"],input[name="principal_site_telephone"],input[name="principal_telephone"],input[name="research_per_tele"],input[name="research_comp_tele"]').usPhoneFormat();
                    });
      </script>
<!--           <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
            <script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>        
            <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
            <script type="text/javascript" src="{{asset('js/wow.min.js')}}"></script>
<!--             <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
                      <script>
                      new WOW().init();
                      </script>
            <script type="text/javascript">
        if($(window).width() < 1023){
              $('.login-main-fture .owl-carousel').owlCarousel({
                  loop:true,
                  margin:10,
                  nav:true,
                  responsive:{
                      0:{
                          items:1
                      },
                      600:{
                          items:1
                      },
                      1000:{
                          items:3
                      }
                  }
              });

            $(document).ready(function(){
              $("footer h4").click(function(){
                $("footer ul").slideToggle();
              });
            });
            }
            </script>


           <script type="text/javascript">     
              var i = 0;
              $(document).ready(function(){            
              $("#add").click(function(){  
                  ++i;     
                  $("#specialdynamic").append('<div class="custom-special"><input type="text" name="addmore['+i+'][principal_specialty]" placeholder="Enter your Specialty" class="form-control" /><button type="button" class="btn btn-danger remove-tr">Remove</button></div>');
              });
             
              $(document).on('click', '.remove-tr', function(){  
                   $(this).parents('.custom-special').remove();
              });  
            });
             
          </script>
            <script type="text/javascript">     
              var i = 0;
              $(document).ready(function(){            
              $("#add_sub").click(function(){  
                  ++i;     
                  $("#subspecialdynamic").append('<div class="custom-special-sub"><input type="text" name="addmoresubs['+i+'][principal_sub_specialty]" placeholder="Enter your Sub Specialty" class="form-control" /><button type="button" class="btn btn-danger remove-tr-sub">Remove</button></div>');
              });
             
              $(document).on('click', '.remove-tr-sub', function(){  
                   $(this).parents('.custom-special-sub').remove();
              });  

            });
             
          </script>
          <script type="text/javascript">     
              var i = 0;
              $(document).ready(function(){            
              $("#add_medical").click(function(){  
                  ++i;     
                  $("#specialdynamic_medical").append('<div class="custom-medical-number"><input type="text" onkeypress="return isNumberKey(this, event);" maxlength="14" name="addmedicallicenses['+i+'][physician_medical_license]" placeholder="Enter your Medical License" class="form-control" /><button type="button" class="btn btn-danger remove-tr-medical_no">Remove</button></div>');
              });
             
              $(document).on('click', '.remove-tr-medical_no', function(){  
                   $(this).parents('.custom-medical-number').remove();
              });  

            });
             
          </script>
          <script type="text/javascript">     
              var i = 0;
              $(document).ready(function(){            
              $("#add_states").click(function(){  
                  ++i;     
                  $("#specialdynamic_medicalstate").append('<div class="custom-medical-state"><input type="text" name="addmedicalstates['+i+'][physician_medical_state]" placeholder="Enter your Medical State" class="form-control" /><button type="button" class="btn btn-danger remove-tr-medical_state">Remove</button></div>');
              });
             
              $(document).on('click', '.remove-tr-medical_state', function(){  
                   $(this).parents('.custom-medical-state').remove();
              });  

            });
             
          </script>
          <script type="text/javascript">    
                      function isNumberKey(txt, evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 46) {
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



