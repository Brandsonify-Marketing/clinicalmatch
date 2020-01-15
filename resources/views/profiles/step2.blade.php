@extends('layouts.register-login')

@section('content')

<style>
.imgContainer{
    float:left;
}
</style>
<section class="login-sec verify-sec">
    <div class="container">
        <h4>Review Your Profile</h4>
        <form action="{{ route('profile.stepstore') }}" method="post" >
            {{ csrf_field() }}
        <div class="login-create-form">
          <div class="verified-section">
            @if(isset($profile->role) && !empty($profile->role))
            <div class="pro-rev-sec">
              <div class="pro-rev-sec-inner">
                <div class="row align-items-center">
                  <div class="col-12 col-md-5 profile-review-data">
                    <h1>{{ @($profile->firstname) ? $profile->firstname : old('firstname') }} {{ @($profile->lastname) ? $profile->lastname : old('lastname') }}</h1>
                    <p><b>Email:</b> {{ Auth::user()->email }}
                    <br>
                    <b>Address Details : </b> {{ @($profile->address) ? $profile->address : old('address') }}
                    <br>
                    <b>Contact Number : </b> {{ @($profile->contact) ? $profile->contact : old('contact') }}
                   </p>
                  </div>
                  <div class="col-12 col-md-7 profile-review-txt">
                    <div class="imgContainer">
                    @if(!empty($profile->image))
                    <p><b>Profile Image:</b></p>                   
                        <img src="{{ url('storage/profile-image/'.$profile->image)}}" height="150" width="200" />                  
                    @endif
                   </div>
                   @if($profile->role == '2')
                    <div class="imgContainer">
                    @if(!empty($profile->physician_cv))
                        <p><b>Physician CV:</b></p>                   
                        <img src="{{ url('storage/physician-cv/'.$profile->physician_cv)}}" hspace="20" height="150" width="200"/>                  
                    @endif
                  </div>
                  @endif
                  @if($profile->role == '6')
                  <div class="imgContainer">
                    @if(!empty($profile->principal_cv))
                        <p><b>Principal Investigator CV:</b></p>  
                        <p>{{$profile->principal_cv}}</p>                 
                        <img src="{{ url('storage/principal-cv/'.$profile->principal_cv)}}" hspace="20" height="150" width="200"/>                  
                    @endif
                  </div>
                  @endif
                  </div>
                </div>
              </div>  
              <div class="pro-rev-sec-inner">
                <div class="row">            
                  @if($profile->role == '2' || $profile->role == '3' || $profile->role == '4')
                  <div class="col-12 col-md-6 col-lg-6 profile-review-txt">
                    <h4>Patient Information</h4>
                    <p>
                    @if(@$profile->patient_first)
                    <b>Patient First Name : </b> {{ @($profile->patient_first) ? $profile->patient_first : old('patient_first') }}
                    <br>
                    @endif
                    @if(@$profile->patient_last)
                    <b>Patient Last Name : </b> {{ @($profile->patient_last) ? $profile->patient_last : old('patient_last') }}
                    <br>
                    @endif
                    @if(@$profile->patient_date)
                    <b>Date of Birth : </b> {{ @($profile->patient_date) ? $profile->patient_date : old('patient_date') }}
                    <br>
                    @endif
                    @if(@$profile->medical_status)
                    <b>Medical Status : </b> {{ @($profile->medical_status) ? $profile->medical_status : old('medical_status') }}
                    <br>
                    @endif
                    @if(@$profile->sex_info)
                    <b>Gender : </b> {{ @($profile->sex_info) ? $profile->sex_info : old('sex_info') }}
                    <br>
                    @endif
                    @if(@$profile->ethnicity_info)
                    <b>Ethnicity : </b> {{ @($profile->ethnicity_info) ? $profile->ethnicity_info : old('ethnicity_info') }}
                    <br>
                    @endif
                    @if(@$profile->race_info)
                    <b>Race : </b>  {{ @($profile->race_info) ? $profile->race_info : old('race_info') }}
                    <br>
                    @endif
                   </p>
                  </div>
                  @endif
                  @if($profile->role == '6' || $profile->role == '7' || $profile->role =='2' || $profile->role=='5')
                  <div class="col-12 col-md-6 col-lg-6 profile-review-txt">
                    <h4>Professional Information</h4>
                    <p><b>Job Title : </b> {{ @($profile->job_title_info) ? $profile->job_title_info : old('job_title_info') }}
                    <br>
                    @if($profile->role == '6')
                        <b>Specialty : </b> {{ @($profile->principal_specialty) ? $profile->principal_specialty : old('principal_specialty') }}
                        <br>
                        <b>Sub Specialty : </b> {{ @($profile->principal_sub_specialty) ? $profile->principal_sub_specialty : old('principal_sub_specialty') }}
                        <br>
                        <b>Medical License Number : </b> {{ @($profile->principal_medical_license) ? $profile->principal_medical_license : old('principal_medical_license') }}
                        <br>
                        <b>Medical License State : </b> {{ @($profile->principal_medical_state) ? $profile->principal_medical_state : old('principal_medical_state') }}
                        <br>
                        <b>Years of clinical research Experience : </b> {{ @($profile->principal_research_experience) ? $profile->principal_research_experience : old('principal_research_experience') }}
                        <br>
                        <b>Therapeutic areas of drug development : </b> {{ @($profile->principal_therapeutic) ? $profile->principal_therapeutic : old('principal_therapeutic') }}
                        <br>
                        <b>Are interested in becoming sub-investigator ? : </b> {{ @($profile->principal_sub) ? $profile->principal_sub : old('principal_sub') }}
                        <br>
                        <b>Research site name : </b> {{ @($profile->principal_site_name) ? $profile->principal_site_name : old('principal_site_name') }}
                        <br>
                        <b>Research site address : </b> {{ @($profile->principal_site_address) ? $profile->principal_site_address : old('principal_site_address') }}
                        <br>
                        <b>Research site telephone : </b> {{ @($profile->principal_site_telephone) ? $profile->principal_site_telephone : old('principal_site_telephone') }}
                        <br>
                        <b>Research site fax : </b> {{ @($profile->principal_fax) ? $profile->principal_fax : old('principal_fax') }}
                        <br>
                        <b>Name of contact person at research site : </b> {{ @($profile->principal_person_company) ? $profile->principal_person_company : old('principal_person_company') }}
                        <br>
                        <b>Email of contact person at research site : </b> {{ @($profile->principal_email) ? $profile->principal_email : old('principal_email') }}
                        <br>
                        <b>Telephone of contact person at research site : </b> {{ @($profile->principal_telephone) ? $profile->principal_telephone : old('principal_telephone') }}
                        <br>
                   </p>
                  </div>
                  @endif
                  @if($profile->role == '7')
                        <b>Company name :  </b> {{ @($profile->research_company) ? $profile->research_company : old('research_company') }}
                        <br>
                        <b>Briefly introduce your company : </b> {{ @($profile->research_brief) ? $profile->research_brief : old('research_brief') }}
                        <br>
                        <b>Name of contact person at company : </b> {{ @($profile->research_per_name) ? $profile->research_per_name : old('research_per_name') }}
                        <br>
                        <b>Contact person telephone : </b> {{ @($profile->research_per_tele) ? $profile->research_per_tele : old('research_per_tele') }}
                        <br>
                        <b>Contact person email : </b> {{ @($profile->research_per_email) ? $profile->research_per_email : old('research_per_email') }}
                        <br>
                        <b>Company contact address :  </b> {{ @($profile->research_per_address) ? $profile->research_per_address : old('research_per_address') }}
                        <br>
                        <b>Company contact telephone : </b> {{ @($profile->research_comp_tele) ? $profile->research_comp_tele : old('research_comp_tele') }}
                        <br>
                        <b>Company contact fax : </b> {{ @($profile->research_comp_fax) ? $profile->research_comp_fax : old('research_comp_fax') }}
                        <br>
                        <b>Therapeutic areas of drug development : </b> {{ @($profile->research_therapeutic) ? $profile->research_therapeutic : old('research_therapeutic') }}
                        <br>
                   </p>
                  </div>
                  @endif
                  @if($profile->role == '5')
                        <b>Briefly introduce your company : </b> {{ @($profile->sponsor_brief) ? $profile->sponsor_brief : old('sponsor_brief') }}
                        <br>
                        <b>Name of contact person at company : </b> {{ @($profile->sponsor_per_name) ? $profile->sponsor_per_name : old('sponsor_per_name') }}
                        <br>
                        <b>Contact person telephone : </b> {{ @($profile->sponsor_per_tele) ? $profile->sponsor_per_tele : old('sponsor_per_tele') }}
                        <br>
                        <b>Contact person email : </b> {{ @($profile->sponsor_per_email) ? $profile->sponsor_per_email : old('sponsor_per_email') }}
                        <br>
                        <b>Company contact address :  </b> {{ @($profile->sponsor_per_address) ? $profile->sponsor_per_address : old('sponsor_per_address') }}
                        <br>
                        <b>Company contact telephone : </b> {{ @($profile->sponsor_comp_tele) ? $profile->sponsor_comp_tele : old('sponsor_comp_tele') }}
                        <br>
                        <b>Company contact fax : </b> {{ @($profile->sponsor_comp_fax) ? $profile->sponsor_comp_fax : old('sponsor_comp_fax') }}
                        <br>
                        <b>Therapeutic areas of drug development : </b> {{ @($profile->sponsor_therapeutic) ? $profile->sponsor_therapeutic : old('sponsor_therapeutic') }}
                        <br>
                   </p>
                  </div>
                  @endif
                  @if($profile->role == '2')
                        <b>Specialty : </b> {{ @($profile->physician_specialty) ? $profile->physician_specialty : old('physician_specialty') }}
                        <br>
                        <b>Sub Specialty : </b> {{ @($profile->physician_sub_specialty) ? $profile->physician_sub_specialty : old('physician_sub_specialty') }}
                        <br>
                        <b>Medical License Number : </b> {{ @($profile->physician_medical_license) ? $profile->physician_medical_license : old('physician_medical_license') }}
                        <br>
                        <b>Medical License State : </b> {{ @($profile->physician_medical_state) ? $profile->physician_medical_state : old('physician_medical_state') }}
                        <br>
                        <b>Do you have clinical research experience? : </b> {{ @($profile->physician_research) ? $profile->physician_research : old('physician_research') }}
                        <br>
                        <b>Years of clinical research Experience : </b> {{ @($profile->physician_research_experience) ? $profile->physician_research_experience : old('physician_research_experience') }}
                        <br>
                        <b>Therapeutic areas of drug development : </b> {{ @($profile->physician_therapeutic) ? $profile->physician_therapeutic : old('physician_therapeutic') }}
                        <br>
                        <b>Are You Interested in becoming Sub-Investigator ? : </b> {{ @($profile->physician_sub) ? $profile->physician_sub : old('physician_sub') }}
                        <br>
                        <b>Clinic Name : </b> {{ @($profile->physician_clinic_info) ? $profile->physician_clinic_info : old('physician_clinic_info') }}
                        <br>
                        <b>Clinic Address : </b> {{ @($profile->physician_clinic_address) ? $profile->physician_clinic_address : old('physician_clinic_address') }}
                        <br>
                        <b>Clinic Telephone : </b> {{ @($profile->physician_clinic_tele) ? $profile->physician_clinic_tele : old('physician_clinic_tele') }}
                        <br>
                        <b>Clinic Fax : </b> {{ @($profile->physician_clinic_fax) ? $profile->physician_clinic_fax : old('physician_clinic_fax') }}
                        <br>
                        <b>Type of Medical Record Storage ? : </b> {{ @($profile->physician_record_storage) ? $profile->physician_record_storage : old('physician_record_storage') }}
                        <br>
                        <b>Name of contact person at clinic : </b> {{ @($profile->clinic_person_contact) ? $profile->clinic_person_contact : old('clinic_person_contact') }}
                        <br>
                        <b>Email of contact person at clinic : </b> {{ @($profile->clinic_person_email) ? $profile->clinic_person_email : old('clinic_person_email') }}
                        <br>
                        <b>Telephone of contact person at clinic : </b> {{ @($profile->clinic_person_telephone) ? $profile->clinic_person_telephone : old('clinic_person_telephone') }}
                        <br>
                        <b>Size of Patient Database : </b> {{ @($profile->clinic_database) ? $profile->clinic_database : old('clinic_database') }}
                        <br>
                        <b>Type of Medical Establishment ? : </b> {{ @($profile->med_est_type) ? $profile->med_est_type : old('med_est_type') }}
                        <br>
                   </p>
                  </div>
                  @endif
                  @endif
<!--                   @if($profile->role == '5' || $profile->role == '6' || $profile->role == '7')
                  <div class="col-12 col-md-6 col-lg-6 profile-review-txt">
                    <h4>Payment Information</h4>
                    <p><b>Credit Card Information : </b> {{ @($profile->credit_card_info) ? $profile->credit_card_info : old('credit_card_info') }}
                    <br>
                    <b>ACH Details : </b> {{ @($profile->ach_info) ? $profile->ach_info : old('ach_info') }}
                    <br>
                   </p>
                  </div>
                  @endif -->
                </div>
              </div> 
            <div class="pro-rev-sec-inner">
                <div class="row">
<!--                   @if($profile->role == '2' || $profile->role == '3' || $profile->role == '4')
                  <div class="col-12 col-md-6 col-lg-6 profile-review-txt">
                    <h4>Banking Information </h4>
                    <p><b>Bank Name : </b> {{ @($profile->bank_name) ? $profile->bank_name : old('bank_name') }}
                    <br>
                    <b>Account Number : </b> {{ @($profile->account_number) ? $profile->account_number : old('account_number') }}
                    <br>
                    <b>Routing Number : </b> {{ @($profile->routing_number) ? $profile->routing_number : old('routing_number') }}
                   </p>
                  </div>
                  @endif -->
                  @if($profile->role == '2' || $profile->role == '3' || $profile->role == '4')
                  <div class="col-12 col-md-6 col-lg-6 profile-review-txt">
                    <h4>Non-Profit Information</h4>
                    <p><b>Charity Name : </b> {{ @($profile->name_charity) ? $profile->name_charity : old('name_charity') }}
                    <br>
                    <b>Charity Address : </b> {{ @($profile->address_charity) ? $profile->address_charity : old('address_charity') }}
                    <br>
                   </p>
                  </div>
                  @endif
                </div>
              </div> 
            </div>
            @endif
            <div class="verify-call">
              <ul class="m-0 p-0">
                <li class="call-verify">
                  <button type="submit" class="btn-typo-purple">Confirm</button>
                </li>
                <li class="go-bck">
                  <a href="{{ route('profile.create') }}">Go Back</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </form>
                    <script type="text/javascript">
                        function showTabs(role) {
                            $(this).prop('checked', true);
                            $('#patientinfo, #companyinfo, #paymentinfo, #bankinfo, #nonprofit', '#personalinfo').slideDown();
                            // $('#patientinfo, #companyinfo, #paymentinfo, #bankinfo, #nonprofit').hide();
                            $('.role-research-coordinators,.role-prinicipal-investigators, .role-pharmaceutical-company, .role-sponsors,.role-patients,.role-physicians').hide();
                            // Role Physicians
                            if (role == 2) {
                                $('#paymentinfo').slideUp();
                                $('#personalinfo,#patientinfo,#companyinfo,#bankinfo,#nonprofit,#complete_profile,#complete_profile').slideDown();
                                $('.role-physicians').show();
                            }
                            // Role Patients & Volunteers
                            else if (role == 3) {
                                $('#companyinfo, #paymentinfo').slideUp();
                                $('#personalinfo,#patientinfo,#bankinfo,#nonprofit,#complete_profile').slideDown();
                                $('.role-patients').show();
                            }
                            // Role Family & Friends of Patients
                            else if (role == 4) {
                                $('#companyinfo,#paymentinfo').slideUp();
                                $('#personalinfo,#patientinfo,#bankinfo,#nonprofit,#complete_profile').slideDown();
                                $('.role-patients').show();
                            }
                            // Role Sponsors
                            else if (role == 5) {
                                $('#patientinfo,#bankinfo,#nonprofit').slideUp();
                                $('#personalinfo,#companyinfo,#paymentinfo,#complete_profile').slideDown();
                                $('.role-sponsors').show();
                            }
                            // Role Prinicipal Investigators
                            else if (role == 6) {
                                $('#patientinfo,#bankinfo,#nonprofit').slideUp();
                                $('#personalinfo,#companyinfo,#paymentinfo,#complete_profile').slideDown();
                                $('.role-prinicipal-investigators').show();
                            }
                            // Role Research Coordinators
                            else if (role == 7) {
                                $('#patientinfo,#bankinfo,#nonprofit').slideUp();
                                $('#personalinfo,#companyinfo,#paymentinfo,#complete_profile').slideDown();
                                $('.role-research-coordinators').show();
                            }
                            //
                        }
                        function show1() {
                            $('#div1').show();
                        }
                        function show2() {
                            $('#div1').hide();
                        }
                        function show_medical() {
                            $('#upload_file').show();
                            $('#upload_medical').show();
                        }
                        function hide_medical() {
                            $('#upload_file').hide();
                            $('#upload_medical').hide();
                        }
                    </script>

    <div class="terms-privacy">
        <ul>
            <li>
                <a href="#">Terms</a>
            </li>
            <li>
                <a href="#">Privacy</a>
            </li>
        </ul>
    </div>
</div>
</section>

@endsection
