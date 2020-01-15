@extends('layouts.dashboard-menu')



@section('content')



<div class="page-container">

    <div class="dashbrd-section">

        <div class="page-title-hdng">

            <h1> Edit Trial Visit</h1>

        </div>

        <div class="clinically-form">

            @if(\Session::has('success'))

            <div class="alert alert-success w-100">

                {{\Session::get('success')}}

            </div>

            @endif
               <div class="submit-paymnt back-btn">
                  <a href="{{ route('clinicalTrialRetention.trial-visit') }}">Back</a>
                </div>

                <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
                    @php
                    $route_id = request()->route('id');
                    $trial_name = App\TrialVisit::where('id', $route_id)->first();
                    @endphp
                     <a href="{{ route('clinicalTrialRetention.trial-visit') }}">Manage Clinical Trial Visits</a>  > 
                     <a href="{{ route('clinicalTrialRetention.edit-trial-visit', $route_id) }}"> Edit Trial Visit</a>  >
                     <a href="#" style="color:#000"> {{$trialvisits->clinicaltrial->study_title}}</a>
                </div>
                <div class="tab-content">
                    <form method="post" action="{{ route('clinicalTrialRetention.update-trial-visit', $trialvisits->id)}}" >
                         @method('PATCH')
                            @csrf

                            <div class="form-group">

                                <label for="clinical_id">Clinical Research:</label>

                                <input type="hidden" name="service_title" value="{{ setting('payment.enrollment_services_title') }}" id="service_title">
                                <input type="hidden" name="service_cost" value="{{ setting('payment.enrollment_services_cost') }}" id="service_cost">

                                @php
                                if(Auth::user()->role_id == 8){
                                $clinicaltrials = App\ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get();
                                }else{
                                $clinicaltrials = App\ClinicalTrial::where('user_id', Auth::user()->id)->where('status', 1)->orderby('id', 'DESC')->get();
                                }
                                @endphp

                                <select name="clinical_id" class="form-control clinical_trial_select">

                                    @foreach($clinicaltrials as $k => $clinicaltrial)

                                    <option value="{{ $clinicaltrial->id }}"{{ ( $trialvisits->clinical_id==$clinicaltrial->id ) ? ' selected' : '' }}>{{ $clinicaltrial->study_title }}</option>

                                    @endforeach

                                </select>

                            </div>

                            @error('clinical_id')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror
                           <div class="form-group">
                                <label for="research_site_id">Research Site:</label>
                                <select name="research_site_id" id="research_site_id" class="form-control">
<!--                                     @foreach($researchSites as $k => $researchSite)
                                    <option value="{{ $researchSite->id }}"{{ ( $trialvisits->research_site_id==$researchSite->id ) ? ' selected' : '' }}>{{ $researchSite->address.", ".$researchSite->state.", ".$researchSite->city.", ".$researchSite->zipcode }}</option>
                                    @endforeach -->
                                </select>
                            </div>
                            @error('research_site_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="visit_name">Visit Name:</label>
                                <input type="text" class="form-control @error('visit_name') is-invalid @enderror" name="visit_name" value="{{$trialvisits->visit_name}}"/>
                            </div>
                            @error('visit_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                         <label for="patient_id"><strong>Patient Name:</strong></label>
                                    <!--                          @php
                                                              $patient_names = App\User::whereIn('role_id', [2, 3,4])->orderby('id', 'DESC')->get();
                                                              @endphp-->
                                    <select  name="patient_id" class="form-control">
                                        <option id="patient_id" selected="selected" disabled>--Patient Name--</option> 
<!--                                                 @foreach($patient_names as $k => $patient_name)
                                                <option value="{{ $patient_name->id }}"{{ ( $trialvisits->patient_id==$patient_name->id ) ? ' selected' : '' }}>{{ @$patient_name->firstname}}</option>
                                                @endforeach -->
                                    </select>
                            </div>
                            @error('patient_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">

                                <label for="date">Date:</label>

                                <input type="text" class="date form-control @error('date') is-invalid @enderror" name="date" value="{{$trialvisits->date}}">

                            </div>

                            @error('date')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror

                            <div class="form-group">

                                <label for="time">Time:</label>

                                <input type="text" class="timepicker form-control @error('time') is-invalid @enderror" onkeydown="return false" value="{{$trialvisits->time}}"name="time"/>

                            </div>
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            @if($trialvisits->status == 1 || $trialvisits->status == 3 || $trialvisits->status == '')
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <br>                           
                                <select name="status" class="form-control">
                                  <option selected="selected" disabled>--Status--</option> 
                                  <option {{{ (isset($trialvisits->status) && $trialvisits->status == '1') ? "selected=\"selected\"" : (old('status') == '1') ? 'selected' : '' }}} value="1">Upcoming</option>
                                   <option {{{ (isset($trialvisits->status) && $trialvisits->status == '2') ? "selected=\"selected\"" : (old('status') == '2') ? 'selected' : '' }}}  value="2">Completed</option>
                                  <option {{{ (isset($trialvisits->status) && $trialvisits->status == '3') ? "selected=\"selected\"" : (old('status') == '3') ? 'selected' : '' }}}  value="3">Canceled</option>
                                </select>
                              @error('status')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                            @endif

                            <div class="form-group">

                                <label for="case_note">Case Notes:</label>

                                <textarea type="text" class="form-control @error('case_note') is-invalid @enderror" name="case_note" value="{{$trialvisits->case_note}}">{{$trialvisits->case_note}}</textarea>

                            </div>

                            @error('case_note')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror


                            <button type="submit" class="btn-typo" name="form1">Update Trial Visit</button>

                        </form>

            </div>

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">

                                    function isNumberKey(txt, evt) {

                                        var charCode = (evt.which) ? evt.which : evt.keyCode;

                                        if (charCode == 46) {

                                            //Check if the text already contains the . character

                                            if (txt.value.indexOf('.') === -1) {

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


<script>
    // GET research site and Patient on change of clinical Trial
    $(document).on('change', '.clinical_trial_select', function () {
        var clinicalTrialId = this.value;
//      research_sites
        $.ajax({
            type: 'get',
            url: "{{ url('clinical-trial/trial-info')}}" + '/' + clinicalTrialId,
            success: function (data) {

                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.message);
                } else {
                    var obj = JSON.parse(data)
                    $('#research_site_id').find('option')
                            .remove()
                            .end();
                    $('#patient_id').find('option')
                            .remove()
                            .end();
                    $.each(obj.research_site, function (key, value) {
                        console.log(value);
                        $('#research_site_id')
                                .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.address + ', ' + value.state + ', ' + value.city + ', ' + value.zipcode));
                    });
                    $.each(obj.patients, function (key, value) {
                        console.log(value);
                        $('#patient_id')
                                .append($("<option></option>")
                                        .attr("value", value.user_id)
                                        .text(value.name));
                    });

//              $('.error').remove();
//              $('#trial-details').html(data);
                }
            },
        });

    });
</script>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">

                                    $('.date').datepicker({

                                        format: "dd-mm-yyyy",

                                        startDate: "+0d"

                                    });

</script> -->

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script>
  $(function() {
    $('input[name="date"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minDate: moment(),
      minYear: 2020,
      maxYear: 2040
    });
    $('input[name="date"]').val('MM-DD-YYYY');
  });
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">

                                    $('.timepicker').datetimepicker({

                                        format: 'HH:mm:ss'

                                    });

</script>

@endsection



