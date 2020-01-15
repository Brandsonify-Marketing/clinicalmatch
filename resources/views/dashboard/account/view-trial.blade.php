@extends('layouts.dashboard-menu')

@section('content')

        <div class="page-container">
            <div class="dashbrd-section">
              @if(\Session::has('success'))
                <div class="alert alert-success w-100">
                    {{\Session::get('success')}}
                </div>
                @endif
              <div class="page-title-hdng">
                <h5>Clinical Trial Management</h5>
                <h1>Clinical Trial Applications</h1>
              </div>
              <div class="submit-paymnt back-btn">
                  <a href="{{ route('account.index') }}">Back</a>
                </div>
              <div class="clinically-form">
                <div class="table-story">
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Full Title of Study
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->clinicaltrial->study_title) && !empty($clinicalmanages->clinicaltrial->study_title))
                                {{ $clinicalmanages->clinicaltrial->study_title }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Principal Investigator’s Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->clinicaltrial->private_name) && !empty($clinicalmanages->clinicaltrial->private_name))
                                {{ $clinicalmanages->clinicaltrial->private_name }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Research Site Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->clinicaltrial->site_name) && !empty($clinicalmanages->clinicaltrial->site_name))
                                {{ $clinicalmanages->clinicaltrial->site_name}}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Phone
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->clinicaltrial->phone_no) && !empty($clinicalmanages->clinicaltrial->phone_no))
                                {{ preg_replace('#(\d{3})(\d{3})(\d{4})#', '$1-$2-$3', $clinicalmanages->clinicaltrial->phone_no) }}
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                             Address
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->clinicaltrial->address) && !empty($clinicalmanages->clinicaltrial->address)
                                || isset($clinicalmanages->clinicaltrial->city) && !empty($clinicalmanages->clinicaltrial->city)
                                || isset($clinicalmanages->clinicaltrial->state) && !empty($clinicalmanages->clinicaltrial->state))
                                {{ $clinicalmanages->clinicaltrial->address }}
                                <br>
                                {{ $clinicalmanages->clinicaltrial->city }}
                                <br>
                                {{ $clinicalmanages->clinicaltrial->state }}
                                <br>
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Volunteer Type
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->clinicaltrial->vol_condition) && !empty($clinicalmanages->clinicaltrial->vol_condition))
                                  {{ $clinicalmanages->clinicaltrial->vol_condition }}
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Rationale for study
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->clinicaltrial->rationale) && !empty($clinicalmanages->clinicaltrial->rationale))
                                {{ $clinicalmanages->clinicaltrial->rationale }}
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
              @if(isset($clinicalmanages->clinicaltrial->form_type) && !empty($clinicalmanages->clinicaltrial->form_type))
                @if($clinicalmanages->clinicaltrial->form_type == 1)
                <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              IRB approved Informed Consent Form (ICF)
                          </div>
                          <div class="story-table-text">
                            <a href="{{asset('storage/irb_forms/'.$clinicalmanages->clinicaltrial->form_irb)}}" target="_blank">
                             <img src="{{ asset('images/informed.png')}}">
                             </a>
                          </div>
                        </div>
                    </div>
                  </div>
                  @endif
                @endif
                </div>
                <div class="table-story">
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Laboratory Results
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->lab_results) && !empty($clinicalmanages->lab_results))
                                {{ $clinicalmanages->lab_results }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Laboratory Date
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->lab_date) && !empty($clinicalmanages->lab_date))
                                {{ $clinicalmanages->lab_date }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Medications
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->medications) && !empty($clinicalmanages->medications))
                                {{ $clinicalmanages->medications }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Placebo Involved
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->placebo) && !empty($clinicalmanages->placebo))
                                   @if($clinicalmanages->placebo == 1)
                                      Yes
                                   @endif
                                   @if($clinicalmanages->placebo == 2)
                                      No
                                   @endif
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                             Inclusion Criteria
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->inc_criteria) && !empty($clinicalmanages->inc_criteria))
                                {{ $clinicalmanages->inc_criteria }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Exclusion Criteria
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->exc_criteria) && !empty($clinicalmanages->exc_criteria))
                                {{ $clinicalmanages->exc_criteria }}
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Medical History
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->medical_history) && !empty($clinicalmanages->medical_history))
                                {{ $clinicalmanages->medical_history }}
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
        </div>

@endsection
