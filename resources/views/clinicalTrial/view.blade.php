@extends('layouts.dashboard-menu')

@section('content')

        <div class="page-container">
              @if(\Session::has('success'))
              <div class="alert alert-success w-100">
                  {{\Session::get('success')}}
              </div>
                @endif
            <div class="dashbrd-section">
              <div class="page-title-hdng">
                <h5>Find a Clinical Trial</h5>
                <h1>View Clinical Trials</h1>
              </div>
              <div class="submit-paymnt back-btn">
              <a href="{{ route('clinicalTrial.index') }}">Back to Clinical Trials</a>
                </div>
             <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
            @php
            $route_id = request()->route('id');
            $trial_name = App\ClinicalTrial::where('id', $route_id)->first();
            @endphp
             <a href="{{ route('clinicalTrial.index') }}">Find a Clinical Trial</a>  > 
             <a href="{{ route('clinicalTrial.view', $route_id) }}"> View Trial</a>  >
             <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
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
                            @if(isset($clinicaltrials->study_title) && !empty($clinicaltrials->study_title))
                                {{ $clinicaltrials->study_title }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Principal Investigator’s Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicaltrials->private_name) && !empty($clinicaltrials->private_name))
                                {{ $clinicaltrials->private_name }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Research Site Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicaltrials->site_name) && !empty($clinicaltrials->site_name))
                                {{ $clinicaltrials->site_name }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Phone
                          </div>
                          <div class="story-table-text">
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
                          <div class="story-table-head">
                             Address
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicaltrials->address) && !empty($clinicaltrials->address)
                                || isset($clinicaltrials->city) && !empty($clinicaltrials->city)
                                || isset($clinicaltrials->address) && !empty($clinicaltrials->address)
                                || isset($clinicaltrials->zipcode) && !empty($clinicaltrials->zipcode))
                                {{ $clinicaltrials->address }}
                                <br>
                                {{ $clinicaltrials->city }}
                                <br>
                                {{ $clinicaltrials->state }}
                                <br>
                                {{ $clinicaltrials->zipcode }}
                                <br>
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Medical Condition
                          </div>
                          <div class="story-table-text">
                            @if(isset($clinicaltrials->medical_condition) && !empty($clinicaltrials->medical_condition))
                                {{ $clinicaltrials->medical_condition }}
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
                          <div class="story-table-head">
                              IRB approved Informed Consent Form (ICF)
                          </div>
                          <div class="story-table-text">
                            <a href="{{asset('storage/irb_forms/'.$clinicaltrials->form_irb)}}" target="_blank">
                             <img src="{{ asset('images/informed.png')}}">  
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
                              <div class="story-table-head">
                                  Apply to become a sub investigator(Physicians Only)
                              </div>
                              <div class="story-table-text">

                              </div>
                            </div>
                        </div>
                      </div>
                      @endif
                @endif      
                </div>

                <div class="decide-btn">
                    <div class="row approve">                 
                    <div class="col save text-left">
                    @if(isset(Auth::user()->role_id) && !empty(Auth::user()->role_id))
                          @if(Auth::user()->role_id == 2 && Auth::user()->role_id == 2)
                              @if(!$subinvestigators) 
                              <a href="{{ route('clinicalTrial.apply-sub-investigator',$clinicaltrials->id) }}" class="approv">APPLY</a>
                              @else
                              <a href="javascript:void(0):" class="approv">ALREADY APPLIED</a> 
                              @endif
                          @endif
                    @endif
                     </div>
                    <div class="col save text-right"> 
                    @if(isset(Auth::user()->role_id) && !empty(Auth::user()->role_id))    
                        @php 
                            if(Auth::user()->role_id == 8)
                            {
                            	$role = "community-managers";
                            }
                            elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                            {
                            	$role = "lower-levels";
                            }
                            elseif(Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7)
                            {
                            	$role = "higher-levels";
                            }
                        @endphp
                    	@if($role == "lower-levels")
		                    @if(!$savedtrials)             
		                    <a href="{{ route('clinicalTrial.saved',$clinicaltrials->id) }}" class="pend">SAVE</a>  
		                    @else
		                    <a href="javascript:void(0):" class="pend">ALREADY SAVED</a> 
		                    @endif              
		                    @if(!$clinicalmanage) 
		                    <a href="{{ route('clinicalTrial.apply',$clinicaltrials->id) }}" class="approv">APPLY</a>
		                    @else
		                    <a href="javascript:void(0):" class="approv">ALREADY APPLIED</a>
		                    @endif
                    	@endif
                    @endif
                    </div>    
                     </div>      
                </div>
              </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script type="text/javascript">
    $(".story-table-sec").each(function (index, value) {
    var maxHeight = 0; 
        $(value).children('.no-gutters').children('.story-table-inner').children('.story-table-head').each(function (indexsub) {
        $this = $(this);
      if ( $this.height() > maxHeight ) {
            maxHeight = $this.height();
        }
     });
    $(value).children('.no-gutters').children('.story-table-inner').children('.story-table-head').height(maxHeight);
    });
    </script>


@endsection
