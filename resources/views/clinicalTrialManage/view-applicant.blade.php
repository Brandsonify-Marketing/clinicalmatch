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
                <h1>Clinical Trial Applicant Management</h1>
              </div>
              <div class="submit-paymnt back-btn">
                  <a href="{{ route('clinicalTrialManage.review-applicants','all') }}">Back</a>
                </div>
             <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
                  @php
                  $route_id = request()->route('id');
                  $trial_name = App\ClinicalManage::where('id', $route_id)->first();
                  @endphp
                   <a href="{{ route('clinicalTrialManage.review-applicants','all')}}">Review & Approve Applicants</a>  > 
                   <a href="{{ route('clinicalTrialManage.review-applicant', $route_id) }}"> Review Applicant</a>  >
                   <a href="#" style="color:#000"> {{$trial_name->user->firstname}}</a>
              </div>
              <div class="clinically-form">
                <form action="{{ route('clinicalTrialManage.applicant-update',$clinicalmanages->id) }}" method="post">
                @csrf
                <div class="table-story">
                  <div class="story-table-sec">
                    <input type="hidden" name="service_title" value="{{ setting('payment.enrollment_services_title') }}" id="service_title">
                    <input type="hidden" name="service_cost" value="{{ setting('payment.enrollment_services_cost') }}" id="service_cost">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Applicant Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->user->firstname) && !empty($clinicalmanages->user->firstname))
                                {{ $clinicalmanages->user->firstname }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Applicant Email
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->user->email) && !empty($clinicalmanages->user->email))
                                {{ $clinicalmanages->user->email }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Address
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->user->profile->address) && !empty($clinicalmanages->user->profile->address))
                                {{ $clinicalmanages->user->profile->address}}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Phone
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->user->profile->contact) && !empty($clinicalmanages->user->profile->contact))
                                {{ $clinicalmanages->user->profile->contact }}
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="table-story">
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Laboratory Results & Date
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->lab_results) && !empty($clinicalmanages->lab_results))
                                {{ $clinicalmanages->lab_results }}
                            @endif
                          </div>
                        </div>
<!--                         <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Laboratory Date
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicalmanages->lab_date) && !empty($clinicalmanages->lab_date))
                                {{ $clinicalmanages->lab_date }}
                            @endif
                          </div>
                        </div> -->
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
<!--                         <div class="story-table-inner col-12 col-lg">
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
                        </div> -->
                    </div>
                  </div>
<!--                   <div class="story-table-sec">
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
                  </div> -->
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
                <div class="decide-btn">
                  @if(isset($clinicalmanages->status) && !empty($clinicalmanages->status))
                      @if($clinicalmanages->status == 1)
                      @endif
                      @if($clinicalmanages->status == 2)
                            <button type="submit" name="status" value="decline" class="dec" >DECLINE</button>
                            <button type="submit" name="status" value="approve" class="approv">APPROVE</button>
                      @endif
                      @if($clinicalmanages->status == 3)
                            <button type="submit" name="status" value="pending" class="pend">PENDING</button>
                            <button type="submit" name="status" value="approve" class="approv">APPROVE</button>
                      @endif
                  @else
                      <button type="submit" name="status" value="decline" class="dec" >DECLINE</button>
                      <button type="submit" name="status" value="approve" class="approv">APPROVE</button>
                  @endif
                </div>
                <form>
              </div>
            </div>
        </div>

@endsection
