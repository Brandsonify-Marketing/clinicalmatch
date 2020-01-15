<!DOCTYPE html>

<html>

<body style="font-family: 'Open Sans', sans-serif;">

<div class="page-container">
              @if(\Session::has('success'))
              <div class="alert alert-success w-100">
                  {{\Session::get('success')}}
              </div>
                @endif
            <div class="dashbrd-section">
              <div class="page-title-hdng">
                <div class="modal-logo text-center" style="text-align: center;">
                  <a href="#">
                    <img src="{{ asset('images/logo.png')}}">
                  </a>
<!--                   <h4 style="font-size: 40px;font-weight: 600; text-align: center;">Clinical Trial Details</h4> -->
                </div>      
              </div>
              <div class="clinically-form">
                <div class="table-story">
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;"> 
                              Full Title of Study
                          </div>
                          <div class="story-table-text" style="padding: .75rem;">
                            @if(isset($clinicaltrials->study_title) && !empty($clinicaltrials->study_title))
                                {{ $clinicaltrials->study_title }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                              Principal Investigator’s Name
                          </div>
                          <div class="story-table-text" style="padding: .75rem;">
                            @if(isset($clinicaltrials->private_name) && !empty($clinicaltrials->private_name))
                                {{ $clinicaltrials->private_name }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                              Research Site Name
                          </div>
                          <div class="story-table-text" style="padding: .75rem;">
                            @if(isset($clinicaltrials->site_name) && !empty($clinicaltrials->site_name))
                                {{ $clinicaltrials->site_name }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                              Phone
                          </div>
                          <div class="story-table-text" style="padding: .75rem;">
                            @if(isset($clinicaltrials->phone_no) && !empty($clinicaltrials->phone_no))
                                {{ preg_replace('#(\d{3})(\d{3})(\d{4})#', '$1-$2-$3', $clinicaltrials->phone_no) }}
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                             Address
                          </div>
                          <div class="story-table-text" style="padding: .75rem;line-height: 1.5;">
                            @if(isset($clinicaltrials->address) && !empty($clinicaltrials->address)
                                || isset($clinicaltrials->city) && !empty($clinicaltrials->city)
                                || isset($clinicaltrials->address) && !empty($clinicaltrials->address))
                                {{ $clinicaltrials->address }}
                                <br>
                                {{ $clinicaltrials->city }}
                                <br> 
                                {{ $clinicaltrials->state }}
                                <br>
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                              Volunteer Type
                          </div>
                          <div class="story-table-text" style="padding: .75rem;">
                            @if(isset($clinicaltrials->vol_condition) && !empty($clinicaltrials->vol_condition))
                                {{ $clinicaltrials->vol_condition }}
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                              Rationale for study
                          </div>
                          <div class="story-table-text" style="padding: .75rem;">
                            @if(isset($clinicaltrials->rationale) && !empty($clinicaltrials->rationale))
                                {{ $clinicaltrials->rationale }}
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
                @if(isset($clinicaltrials->form_type) && !empty($clinicaltrials->form_type))
                @if($clinicaltrials->form_type == 1 && $clinicaltrials->form_type == 1)
                <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                              IRB approved Informed Consent Form (ICF)
                          </div>
                          <div class="story-table-text" style="padding: .75rem;">
                            <a href="{{asset('storage/irb_forms/'.$clinicaltrials->form_irb)}}" target="_blank">
                             <img style="margin-top:.75rem;" src="{{ asset('images/informed.png')}}">  
                             </a>              
                          </div>
                        </div>
                    </div>
                  </div>
                  @endif
                @endif  
                  @if(isset(Auth::user()->role_id) && !empty(Auth::user()->role_id))
                          @if(Auth::user()->role_id == 2 && Auth::user()->role_id == 2)
                  <div class="story-table-sec">
                        <div class="row no-gutters">
                            <div class="story-table-inner col-12 col-lg">
                              <div class="story-table-head" style="background: #cccccc;padding: .75rem;font-weight: 600;">
                                  Apply to become a sub investigator(Physicians Only)
                              </div>
                              <div class="story-table-text" >
                              </div>
                            </div>
                        </div>
                      </div>
                      @endif
                @endif      
                </div>
              </div>
            </div>
        </div>


</body>

</html>