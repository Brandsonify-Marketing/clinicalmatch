@extends('layouts.dashboard-menu')

@section('content')

        <div class="page-container">
            <div class="dashbrd-section">
              <div class="page-title-hdng">
                <h5>Clinical Trial Management</h5>
                <h1>Sub-Investigator Application Management</h1>
              </div>
              <div class="submit-paymnt back-btn">
                  <a href="{{ route('clinicalTrialManage.investigator') }}">Back</a>
                </div>
              <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
                  @php
                  $route_id = request()->route('id');
                  $trial_name = App\Subinvestigator::where('id', $route_id)->first();
                  @endphp
                   <a href="{{ route('clinicalTrialManage.investigator')}}">Review & Approve Sub-Investigator Applications</a>  > 
                   <a href="{{ route('clinicalTrialManage.view-investigator', $route_id) }}"> Review Sub-Investigator Details</a>  >
                   <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
              </div>
              <div class="clinically-form">
                <form action="{{ route('clinicalTrialManage.update-investigator',$subinvestigators->id) }}" method="post">
                @csrf
                <div class="table-story">
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Full Title of Study
                          </div>
                          <div class="story-table-text">
                            @if(isset($subinvestigators->study_title) && !empty($subinvestigators->study_title))
                                {{ $subinvestigators->study_title }}
                            @endif
                          </div>
                        </div>
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Research Site Name
                          </div>
                          <div class="story-table-text">
                            @if(isset($subinvestigators->site_name) && !empty($subinvestigators->site_name))
                                {{ $subinvestigators->site_name }}
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
                            @if(isset($subinvestigators->address) && !empty($subinvestigators->address)
                                || isset($subinvestigators->city) && !empty($subinvestigators->city)
                                || isset($subinvestigators->address) && !empty($subinvestigators->address))
                                {{ $subinvestigators->address }}
                                <br>
                                {{ $subinvestigators->city }}
                                <br>
                                {{ $subinvestigators->state }}
                                <br>
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              Mechanism
                          </div>
                          <div class="story-table-text">

                            <ul>
                              <li>
                               @if(isset($subinvestigators->mechanism) && !empty($subinvestigators->mechanism))
                                 {{ $subinvestigators->mechanism }}
                               @endif
                              </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="story-table-sec">
                    <div class="row no-gutters">
                        <div class="story-table-inner col-12 col-lg">
                          <div class="story-table-head">
                              List of Benefits
                          </div>
                          <div class="story-table-text">
                            @if(isset($subinvestigators->list_benefits) && !empty($subinvestigators->list_benefits))
                                {{ $subinvestigators->list_benefits }}
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
                <div class="decide-btn">
                  @if(isset($subinvestigators->status) && !empty($subinvestigators->status))
                      @if($subinvestigators->status == 1)
                      @endif               
                      @if($subinvestigators->status == 2)
                            <button type="submit" name="status" value="decline" class="dec" >DECLINE</button>
                            <button type="submit" name="status" value="approve" class="approv">APPROVE</button>
                      @endif 
                      @if($subinvestigators->status == 3)
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
