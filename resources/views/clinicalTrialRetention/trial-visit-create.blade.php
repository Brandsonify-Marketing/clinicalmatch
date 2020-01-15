@extends('layouts.dashboard-menu')



@section('content')



<div class="page-container">

    <div class="dashbrd-section">

        <div class="page-title-hdng">

            <h1> Add Trial Visit</h1>

        </div>

        <div class="clinically-form">

            @if(\Session::has('success'))

            <div class="alert alert-success w-100">

                {{\Session::get('success')}}

            </div>

            @endif

            <div class="containers">

                <div class="tab-content">

                    <div id="patients" class="containers tab-pane active"><br>

                        <form method="post" action="{{ route('clinicalTrialRetention.store-trial-visit') }}">

                            <input type="hidden" value="{{csrf_token()}}" name="_token" />

                            <div class="form-group">

                                <label for="clinical_id">Clinical Research:</label>

                                <select name="clinical_id" class="form-control">

                                    @foreach($clinicaltrials as $k => $clinicaltrial)

                                    <option value="{{ $clinicaltrial->id }}">{{ $clinicaltrial->study_title }}</option>

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

                                <select name="research_site_id" class="form-control">

                                    @foreach($researchSites as $k => $researchSite)

                                    <option value="{{ $researchSite->id }}">{{ $researchSite->address.", ".$researchSite->state.", ".$researchSite->city.", ".$researchSite->zipcode }}</option>

                                    @endforeach

                                </select>

                            </div>

                            @error('research_site_id')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror

                           <div class="form-group">

                                <label for="patient_id">Patient ID:</label>

                                <input type="text" class="form-control @error('patient_id') is-invalid @enderror" name="patient_id" value="{{ old('patient_id') }}"/>

                            </div>

                            @error('patient_id')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror

                            <div class="form-group">

                                <label for="date">Date:</label>

                                <input placeholder="Date(MM/DD/YYYY)" onkeydown="return false" type="text" class="date form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">

                            </div>

                            @error('date')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror

                            <div class="form-group">

                                <label for="time">Time:</label>

                                <input type="text" class="timepicker form-control @error('time') is-invalid @enderror" onkeydown="return false" value="{{ old('time') }}"name="time"/>

                            </div>

                            @error('time')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror

                            <div class="form-group">

                                <label for="status">Status:</label>

                                <select name="status" class="form-control">

                                    <option value="1"> Upcoming </option>

                                    <option value="2"> Completed </option>

                                    <option value="3"> Canceled </option>

                                </select>

                            </div>

                            @error('status')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror

                            <div class="form-group">

                                <label for="case_note">Case Note:</label>

                                <textarea type="text" class="form-control @error('case_note') is-invalid @enderror" name="case_note" value="{{ old('case_note') }}"></textarea>

                            </div>

                            @error('case_note')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror



                            <button type="submit" class="btn-typo" name="form1">Add Trial Visit</button>

                        </form>

                    </div>

                </div>

            </div>

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

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">

                                    $('.date').datepicker({

                                        format: "dd-mm-yyyy",

                                        startDate: "+0d"

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



