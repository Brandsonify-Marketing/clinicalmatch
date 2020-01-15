@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
        <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>Update Professional Information</h1>
            </div>
            <div class="submit-paymnt back-btn">
                  <a href="{{ route('account.professional.index') }}">Back</a>
            </div>
            @if(Auth::user()->role_id =='7')
            <div class="clinically-form">
<!--                     @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    @endif -->
                    
                    <form action="{{ route('account.professional.update') }}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="job_title_info">Job Title:</label>
                            <input type="text" class="form-control @error('job_title_info') is-invalid @enderror" name="job_title_info" value={{@$profile->job_title_info}}>
                        </div>
                        <div class="form-group">
                            <label for="research_company">Company Name:</label>
                            <input type="text" class="form-control @error('research_company') is-invalid @enderror" name="research_company" value={{@$profile->research_company}}>
                        </div>
                        <div class="form-group">
                            <label for="research_company">Brief Description About Research:</label>
                            <textarea  class="form-control @error('research_brief') is-invalid @enderror" name="research_brief" placeholder="Briefly introduce your company">{{ @$profile->research_brief }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="research_per_name">Name of Contact Person at Company:</label>
                            <input type="text" class="form-control @error('research_per_name') is-invalid @enderror" name="research_per_name" value={{@$profile->research_per_name}}>
                        </div>
                        <div class="form-group">
                            <label for="research_per_tele">Contact Person telephone:</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('research_per_tele') is-invalid @enderror" name="research_per_tele" value="{{@$profile->research_per_tele}}" >
                        </div>
                        <div class="form-group">
                            <label for="research_per_email">Contact Person email:</label>
                            <input type="email" class="form-control @error('research_per_email') is-invalid @enderror" name="research_per_email" value={{@$profile->research_per_email}}>
                        </div>
                        <div class="form-group">
                            <label for="research_per_address">Contact Person Address:</label>
                            <input type="text" class="form-control @error('research_per_address') is-invalid @enderror" name="research_per_address" value={{@$profile->research_per_address}}>
                        </div>
                        <div class="form-group">
                            <label for="research_comp_tele">Company Contact telephone:</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('research_comp_tele') is-invalid @enderror" name="research_comp_tele" value="{{@$profile->research_comp_tele}}" >
                        </div>
                        <div class="form-group">
                            <label for="research_comp_fax">Company Contact Fax:</label>
                            <input type="text" maxlength="7" class="form-control @error('research_comp_fax') is-invalid @enderror" name="research_comp_fax" value={{@$profile->research_comp_fax}}>
                        </div>          
                        <button type="submit" class="btn-typo">Update</button>
                    </form>             
            </div>
            @endif
            @if(Auth::user()->role_id =='6')
            <div class="clinically-form">
<!--                     @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    @endif -->
                    
                    <form action="{{ route('account.professional.update') }}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="job_title_info">Job Title:</label>
                            <input type="text" class="form-control @error('job_title_info') is-invalid @enderror" name="job_title_info" value={{@$profile->job_title_info}}>
                        </div>
<!--                         <div class="form-group">
                            <label for="principal_specialty">Specialty:</label>
                            <input type="text" class="form-control @error('principal_specialty') is-invalid @enderror" name="principal_specialty" value={{@$profile->principal_specialty}}>
                        </div> -->
                        <div class="form-group" id="specialdynamic">
                        <label for="principal_specialty">Specialty:</label>	
                         <input type="text" placeholder="Specialty*" class="form-control @error('principal_specialty') is-invalid @enderror" name="addmore[0][principal_specialty]" value={{@$profile->principal_specialty}}>
                        <div class="upload_files">
                        <span><button type="button" name="add" id="add">Add More Specialties</button></span>
                       </div>
                        </div>
                        <div class="form-group" id="subspecialdynamic">
                        <label for="principal_sub_specialty">Sub Specialty:</label>	
                         <input type="text" placeholder="Sub Specialty*" class="form-control @error('principal_sub_specialty') is-invalid @enderror" name="addmoresubs[0][principal_sub_specialty]" value={{@$profile->principal_sub_specialty}}>
                        <div class="upload_files">
                        <span><button type="button" name="add_sub" id="add_sub">Add More Sub Specialties</button></span>
                       </div>
                        </div>
<!--                         <div class="form-group">
                            <label for="principal_sub_specialty">Sub Specialty:</label>
                            <input type="text" class="form-control @error('principal_sub_specialty') is-invalid @enderror" name="principal_sub_specialty" value={{@$profile->principal_sub_specialty}}>
                        </div> -->
                        <div class="form-group">
                            <label for="principal_medical_license">Medical License Number:</label>
                            <input type="text" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control @error('principal_medical_license') is-invalid @enderror" name="principal_medical_license" value="{{@$profile->principal_medical_license}}" >
                        </div>
                        <div class="form-group">
                            <label for="principal_medical_state">Medical License State:</label>
                            <input type="text" class="form-control @error('principal_medical_state') is-invalid @enderror" name="principal_medical_state" value={{@$profile->principal_medical_state}}>
                        </div>
                        <div class="form-group">
                            <label for="principal_research_experience">Years of clinical research Experience:</label>
                            <input type="text" maxlength="2" onkeypress="return isNumberKey(this, event);" class="form-control @error('principal_research_experience') is-invalid @enderror" name="principal_research_experience" value="{{@$profile->principal_research_experience}}" >
                        </div>
                        <div class="form-group">
                            <label for="principal_therapeutic">Therapeutic areas of clinical research experience:</label>
                            <textarea class="form-control @error('principal_therapeutic') is-invalid @enderror" name="principal_therapeutic" placeholder="Briefly introduce your company">{{ @$profile->principal_therapeutic }}</textarea>
                        </div>
                       <div class="form-group">
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
                        <div class="form-group">
<!--                           <div class="upload_files"> -->
<!--                             <span>Principal CV: <input type="file" name="principal_cv" value={{ @$profile->principal_cv }}></span> -->
                            <span>Principal CV: <input type="file" 
                                          class="filepond"
                                          name="principal_cv"
                                          accept="image/png, image/jpeg, image/gif"/>
                            </span> 
<!--                             <p>{{@$profile->principal_cv}}</p> -->
                            <a href="{{asset('storage/principal-cv/'.$profile->principal_cv)}}" target="_blank">
                                {{@$profile->principal_cv}}
                             </a>  
<!--                             @if(!empty($profile->principal_cv))
                            <img src="{{ url('storage/principal-cv/'.$profile->principal_cv)}}" width="200px"/> 
                            @else                    
                            @endif -->
<!--                           </div> -->
                        @error('principal_cv')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color:red">{{ $message }}</strong>
                                </span>
                        @enderror

                        </div>
                        <div class="form-group">
                            <label for="principal_site_name">Research Site Name:</label>
                            <input type="text" class="form-control @error('principal_site_name') is-invalid @enderror" name="principal_site_name" value={{@$profile->principal_site_name}}>
                        </div>
                        <div class="form-group">
                            <label for="principal_site_address">Research Site Address:</label>
                            <input type="text" class="form-control @error('principal_site_address') is-invalid @enderror" name="principal_site_address" value={{@$profile->principal_site_address}}>
                        </div>
                        <div class="form-group">
                            <label for="principal_site_telephone">Research Site telephone:</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('principal_site_telephone') is-invalid @enderror" name="principal_site_telephone" value="{{@$profile->principal_site_telephone}}" >
                        </div>
                        <div class="form-group">
                            <label for="principal_fax">Research Site fax:</label>
                            <input type="text" maxlength="7" class="form-control @error('principal_fax') is-invalid @enderror" name="principal_fax" value={{@$profile->principal_fax}}>
                        </div>
                        <div class="form-group">
                            <label for="principal_person_company">Name of contact person at research site:</label>
                            <input type="text" class="form-control @error('principal_person_company') is-invalid @enderror" name="principal_person_company" value={{@$profile->principal_person_company}}>
                        </div>
                        <div class="form-group">
                            <label for="principal_email">Email of Contact Person at research Site:</label>
                            <input type="email" class="form-control @error('principal_email') is-invalid @enderror" name="principal_email" value={{@$profile->principal_email}}>
                        </div>
                        <div class="form-group">
                            <label for="principal_telephone">Telephone of contact person at research site</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('principal_telephone') is-invalid @enderror" name="principal_telephone" value="{{@$profile->principal_telephone}}" >
                        </div>
                        
                        <button type="submit" class="btn-typo">Update</button>
                    </form>             
            </div>
            @endif
            @if(Auth::user()->role_id =='5')
            <div class="clinically-form">
<!--                     @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    @endif -->
                    
                    <form action="{{ route('account.professional.update') }}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="job_title_info">Job Title:</label>
                            <input type="text" class="form-control @error('job_title_info') is-invalid @enderror" name="job_title_info" value={{@$profile->job_title_info}}>
                        </div>
                        <div class="form-group">
                            <label for="sponsor_company">Company Name:</label>
                            <input type="text" class="form-control @error('sponsor_company') is-invalid @enderror" name="sponsor_company" value={{@$profile->sponsor_company}}>
                        </div>
                         <div class="form-group">
                            <label for="sponsor_brief">Briefly introduce your company:</label>
                            <textarea class="form-control @error('sponsor_brief') is-invalid @enderror" name="sponsor_brief" placeholder="Briefly introduce your company">{{ @$profile->sponsor_brief }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="sponsor_per_name">Name of Contact Person at Company:</label>
                            <input type="text" class="form-control @error('sponsor_per_name') is-invalid @enderror" name="sponsor_per_name" value={{@$profile->sponsor_per_name}}>
                        </div>
                        <div class="form-group">
                            <label for="sponsor_per_tele">Contact Person telephone:</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('sponsor_per_tele') is-invalid @enderror" name="sponsor_per_tele" value="{{@$profile->sponsor_per_tele}}" >
                        </div>
                        <div class="form-group">
                            <label for="sponsor_per_email">Contact Person email:</label>
                            <input type="email" class="form-control @error('sponsor_per_email') is-invalid @enderror" name="sponsor_per_email" value={{@$profile->sponsor_per_email}}>
                        </div>
                        <div class="form-group">
                            <label for="sponsor_per_address">Contact Person Address:</label>
                            <input type="text" class="form-control @error('sponsor_per_address') is-invalid @enderror" name="sponsor_per_address" value={{@$profile->sponsor_per_address}}>
                        </div>
                        <div class="form-group">
                            <label for="sponsor_comp_tele">Company Contact telephone:</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('sponsor_comp_tele') is-invalid @enderror" name="sponsor_comp_tele" value="{{@$profile->sponsor_comp_tele}}" >
                        </div>
                        <div class="form-group">
                            <label for="sponsor_comp_fax">Company Contact Fax:</label>
                            <input type="text" class="form-control @error('sponsor_comp_fax') is-invalid @enderror" name="sponsor_comp_fax" value={{@$profile->sponsor_comp_fax}}>
                        </div>
                        <div class="form-group">
                            <label for="sponsor_therapeutic">Therapeutic areas of drug development:</label>
                            <textarea class="form-control @error('sponsor_therapeutic') is-invalid @enderror" name="sponsor_therapeutic" placeholder="Briefly introduce your company">{{ @$profile->sponsor_therapeutic }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn-typo">Update</button>
                    </form>                
            </div>
            @endif
            @if(Auth::user()->role_id =='2')
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
                    <form action="{{ route('account.professional.update') }}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="job_title_info">Job Title:</label>
                            <input type="text" class="form-control @error('job_title_info') is-invalid @enderror" name="job_title_info" value={{@$profile->job_title_info}}>
                        </div>
                        <div class="form-group">
                            <label for="physician_specialty">Specialty:</label>
                            <input type="text" class="form-control @error('physician_specialty') is-invalid @enderror" name="physician_specialty" value={{@$profile->physician_specialty}}>
                        </div>
                        <div class="form-group">
                            <label for="physician_sub_specialty">Sub Specialty:</label>
                            <input type="text" class="form-control @error('physician_sub_specialty') is-invalid @enderror" name="physician_sub_specialty" value={{@$profile->physician_sub_specialty}}>
                        </div>
<!--                         <div class="form-group">
                            <label for="physician_medical_license">Medical License Number:</label>
                            <input type="text" onkeypress="return isNumberKey(this, event);" class="form-control @error('physician_medical_license') is-invalid @enderror" name="physician_medical_license" value="{{@$profile->physician_medical_license}}" >
                        </div> -->
                       <div class="form-group" id="specialdynamic_medical">
                        <label for="physician_medical_license">Medical License Number:</label>	
                         <input type="text" maxlength="10" placeholder="Medical License Number*" onkeypress="return isNumberKey(this, event);" class="form-control @error('physician_medical_license') is-invalid @enderror" name="addmedicallicenses[0][physician_medical_license]" value={{@$profile->physician_medical_license}}>
                        <div class="upload_files">
                        <span><button type="button" name="add_medical" id="add_medical">Add More Medical License Numbers</button></span>
                       </div>
                        </div>
                      <div class="form-group" id="specialdynamic_medicalstate">
                        <label for="physician_medical_state">Medical License State:</label>	
                         <input type="text" placeholder="Medical License State*" class="form-control @error('physician_medical_state') is-invalid @enderror" name="addmedicalstates[0][physician_medical_state]" value={{@$profile->physician_medical_state}} >
                        <div class="upload_files">
                        <span><button type="button" name="add_states" id="add_states">Add More Medical License States</button></span>
                       </div>
                        </div>
<!--                         <div class="form-group">
                            <label for="physician_medical_state">Medical License State:</label>
                            <input type="text" class="form-control @error('physician_medical_state') is-invalid @enderror" name="physician_medical_state" value={{@@$profile->physician_medical_state}}>
                        </div> -->
                        <div class="form-group">
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
                                @if(isset($profile->physician_research_experience) && !empty($profile->physician_research_experience && $profile->physician_research == 1))
                                @if($profile->physician_research == 1)
                                <label>Years of clinical research experience</label>
                                <div class="form-group" id="div1">
                                        <input type="text" placeholder="Years of clinical research information*" onkeypress="return isNumberKey(this, event);" class="form-control @error('physician_research_experience') is-invalid @enderror" name="physician_research_experience" value="{{ old('physician_research_experience',$profile->physician_research_experience ?? '') }}" >
                                </div>
                                @endif
                                @endif
                          @error('physician_research')
                          <span class="invalid-feedback" role="alert">
                              <strong style="color:red">{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
<!--                         <div class="form-group">
                            <label for="physician_therapeutic">Therapeutic areas of drug development:</label>
                            <textarea class="form-control @error('physician_therapeutic') is-invalid @enderror" name="physician_therapeutic" placeholder="Briefly introduce your company">{{ @$profile->physician_therapeutic }}</textarea>
                        </div> -->
                        <div class="form-group">
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
                        <div class="form-group">
                          <div class="upload_files">
                            <span>Physician CV: <input type="file" name="physician_cv" value={{ @$profile->physician_cv }}></span>
                            @if(!empty($profile->physician_cv))
                            <img src="{{ url('storage/physician-cv/'.$profile->physician_cv)}}" width="200px"/> 
                            @else                    
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="physician_clinic_info">Clinic Name:</label>
                            <input type="text" class="form-control @error('physician_clinic_info') is-invalid @enderror" name="physician_clinic_info" value={{@$profile->physician_clinic_info}}>
                        </div>
                        <div class="form-group">
                            <label for="physician_clinic_address">Clinic Address:</label>
                            <input type="text" class="form-control @error('physician_clinic_address') is-invalid @enderror" name="physician_clinic_address" value={{@$profile->physician_clinic_address}}>
                        </div>
                        <div class="form-group">
                            <label for="physician_clinic_tele">Clinic telephone:</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('physician_clinic_tele') is-invalid @enderror" name="physician_clinic_tele" value={{@$profile->physician_clinic_tele}} >
                        </div>
                        <div class="form-group">
                            <label for="physician_clinic_fax">Clinic fax:</label>
                            <input type="text" class="form-control @error('physician_clinic_fax') is-invalid @enderror" name="physician_clinic_fax" value={{@$profile->physician_clinic_fax}}>
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            <label for="clinic_person_contact">Name of contact person at clinic:</label>
                            <input type="text" class="form-control @error('clinic_person_contact') is-invalid @enderror" name="clinic_person_contact" value={{@$profile->clinic_person_contact}}>
                        </div>
                        <div class="form-group">
                            <label for="clinic_person_email">Email of Contact Person at clinic:</label>
                            <input type="email" class="form-control @error('clinic_person_email') is-invalid @enderror" name="clinic_person_email" value={{@$profile->clinic_person_email}}>
                        </div>
                        <div class="form-group">
                            <label for="clinic_person_telephone">Telephone of contact person at clinic:</label>
                            <input type="text" maxlength="10" placeholder="xxx-xxx-xxxx" onkeypress="return isNumberKey(this, event);" class="form-control @error('clinic_person_telephone') is-invalid @enderror" name="clinic_person_telephone" value={{@$profile->clinic_person_telephone}} >
                        </div>
                        <div class="form-group">
                            <label for="clinic_database">Size of Patient Database:</label>
                            <input type="text" class="form-control @error('clinic_database') is-invalid @enderror" name="clinic_database" value={{@$profile->clinic_database}}>
                        </div>
                        <div class="form-group">
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
                                    <input type="radio" name="med_est_type" value="3" onclick="other2();" onclick="other2();" {{{ (isset($profile->med_est_type) && $profile->med_est_type == '3') ? "checked" : (old('med_est_type') == '3') ? 'checked' : '' }}}>
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

                        <div class="form-group" id="other-name-val" style="display:none">
                                    <input type="text" placeholder="Name of Medical Establishment*" class="form-control @error('other_name') is-invalid @enderror" name="other_name" id="other_name" value="{{ old('other_name',$profile->other_name ?? '') }}" >
                                </div>
                          @error('other_name')
                          <span class="invalid-feedback" role="alert">
                              <strong style="color:red">{{ $message }}</strong>
                          </span>
                                          @enderror            
                        <button type="submit" class="btn-typo">Update</button>
                    </form>             
            </div>
            @endif
          </div>
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
            function show1(){
              $('#div1').show();
            }
            function show2(){
              $('#div1').hide();
            }
            function other1(){
              $('#other-name-val').show();
            }
            function other2(){
              $('#other-name-val').hide();
            }
            // $(document).ready(function(){
            //     $('input[name="med_est_type"]').click(function(){
            //           if($(this).attr("value")=="1" && $(this).attr("value")=="2" && $(this).attr("value")=="3"){
            //               $("#other-name-val").hide();
            //               $("#other-name").val('');
            //           }
            //           if($(this).attr("value")=="4"){
            //               $("#other-name-val").show();
            //           }        
            //       });
            //   $('input[name="med_est_type"]').trigger('click');
            // });
			// $('input[type="radio"]').change(function(){
			//     var i = $(this).val();
			//     if(i==1 || i==2 || i==3 )
			//     {
			//     	$('#other_name').attr('value', '');
			//     }

			// });

            function show_medical(){
              $('#upload_file').show();
              $('#upload_medical').show();
            }
            function hide_medical(){
              $('#upload_file').hide();
              $('#upload_medical').hide();
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
                  $("#specialdynamic_medical").append('<div class="custom-medical-number"><input type="text" onkeypress="return isNumberKey(this, event);" name="addmedicallicenses['+i+'][physician_medical_license]" placeholder="Enter your Medical License" class="form-control" /><button type="button" class="btn btn-danger remove-tr-medical_no">Remove</button></div>');
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
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.11/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
                  $('input[name="contact"],input[name="patient_phy__phone"],input[name="care_giver_phone"],input[name="physician_clinic_tele"],input[name="clinic_person_telephone"],input[name="sponsor_per_tele"],input[name="sponsor_comp_tele"],input[name="principal_site_telephone"],input[name="principal_telephone"],input[name="research_per_tele"],input[name="research_comp_tele"]').usPhoneFormat();
            });
</script>
@endsection