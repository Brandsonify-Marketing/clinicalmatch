@extends('layouts.dashboard-menu')

@section('content')

        <div class="page-container">
            <div class="dashbrd-section">
              <div class="page-title-hdng">
                <h5>Clinical Trial Management</h5>
                <h1>Review & Approve Clinical Trials</h1>
              </div>
              <div class="submit-paymnt back-btn">
                  <a href="{{ route('clinicalTrialManage.review','all') }}">Back to Clinical Trials</a>
                </div>
        <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
            @php
            $route_id = request()->route('id');
            $trial_name = App\ClinicalTrial::where('id', $route_id)->first();
            @endphp
             <a href="{{ route('clinicalTrialManage.review','all') }}">Review & Approve Clinical Trials</a>  > 
             <a href="{{ route('clinicalTrialManage.review-trial', $route_id) }}"> Review Clinical Trial</a>  >
             <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
        </div>
              <div class="clinically-form">
                <form action="{{ route('clinicalTrialManage.review-update',$clinicaltrials->id) }}" method="post">
                @csrf
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
                          <div class="story-table-head">
                              Volunteer Type
                          </div>
                          <div class="story-table-text">
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
                @if($clinicaltrials->form_type == 1)
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
                </div>
                <div class="decide-btn">
                  @if(isset($clinicaltrials->status) && !empty($clinicaltrials->status))
                      @if($clinicaltrials->status == 1)
                      @endif               
                      @if($clinicaltrials->status == 2)
                            <button type="submit" name="status" value="decline" class="dec" >DECLINE</button>
                            <button type="submit" name="status" value="approve" class="approv">APPROVE</button>
                      @endif 
                      @if($clinicaltrials->status == 3)
                            <button type="submit" name="status" value="pending" class="pend">PENDING</button>
                            <button type="submit" name="status" value="approve" class="approv">APPROVE</button>
                      @endif
                  @else
                      <button type="submit" name="status" value="decline" class="dec" >DECLINE</button>
                      <button type="submit" name="status" value="pending" class="pend">PENDING</button>
                      <button type="submit" name="status" value="approve" class="approv">APPROVE</button>
                  @endif
                  </div>
                <form>
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