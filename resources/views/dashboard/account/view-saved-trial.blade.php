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
                <h1>Saved Applications</h1>
              </div>
              <div class="submit-paymnt back-btn">
                  <a href="{{ route('account.saved') }}">Back</a>
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
                            @if(isset($savedtrials->clinicaltrial->study_title) && !empty($savedtrials->clinicaltrial->study_title))
                                {{ $savedtrials->clinicaltrial->study_title }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Principal Investigator’s Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($savedtrials->clinicaltrial->private_name) && !empty($savedtrials->clinicaltrial->private_name))
                                {{ $savedtrials->clinicaltrial->private_name }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Research Site Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($savedtrials->clinicaltrial->site_name) && !empty($savedtrials->clinicaltrial->site_name))
                                {{ $savedtrials->clinicaltrial->site_name}}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Phone
                          </div>
                          <div class="story-table-text">
                            @if(isset($savedtrials->clinicaltrial->phone_no) && !empty($savedtrials->clinicaltrial->phone_no))
                                {{ preg_replace('#(\d{3})(\d{3})(\d{4})#', '$1-$2-$3', $savedtrials->clinicaltrial->phone_no) }}
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
                            @if(isset($savedtrials->clinicaltrial->address) && !empty($savedtrials->clinicaltrial->address)
                                || isset($savedtrials->clinicaltrial->city) && !empty($savedtrials->clinicaltrial->city)
                                || isset($savedtrials->clinicaltrial->state) && !empty($savedtrials->clinicaltrial->state))
                                {{ $savedtrials->clinicaltrial->address }}
                                <br>
                                {{ $savedtrials->clinicaltrial->city }}
                                <br>
                                {{ $savedtrials->clinicaltrial->state }}
                                <br>
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Volunteer Type
                          </div>
                          <div class="story-table-text">
                            @if(isset($savedtrials->clinicaltrial->vol_condition) && !empty($savedtrials->clinicaltrial->vol_condition))
                                  {{ $savedtrials->clinicaltrial->vol_condition }}
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
                            @if(isset($savedtrials->clinicaltrial->rationale) && !empty($savedtrials->clinicaltrial->rationale))
                                {{ $savedtrials->clinicaltrial->rationale }}
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
              @if(isset($savedtrials->clinicaltrial->form_type) && !empty($savedtrials->clinicaltrial->form_type))
                @if($savedtrials->clinicaltrial->form_type == 1)
                <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              IRB approved Informed Consent Form (ICF)
                          </div>
                          <div class="story-table-text">
                            <a href="{{asset('storage/irb_forms/'.$savedtrials->clinicaltrial->form_irb)}}" target="_blank">
                             <img src="{{ asset('images/informed.png')}}">
                             </a>
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

@endsection
