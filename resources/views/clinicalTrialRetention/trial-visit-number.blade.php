@extends('layouts.dashboard-menu')
@section('content')

<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h1>Number of Trial Visits</h1>
        </div>
        <div class="clinically-form">
            @if(\Session::has('success'))
            <div class="alert alert-success w-100">
                {{\Session::get('success')}}
            </div>
            @endif
<!--             <div class="container"> -->
                <div class="tab-content">
<!--                     <div id="patients" class="containers tab-pane active"><br> -->
                 <div class="submit-paymnt back-btn">
                  <a href="{{ route('clinicalTrialRetention.enrolled') }}">Back</a>
                </div>
                <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
                    @php
                    $route_id = request()->route('id');
                    $trial_name = App\ClinicalTrial::where('id', $route_id)->first();
                    @endphp
                     <a href="{{ route('clinicalTrialRetention.enrolled') }}">Manage Enrolled Clinical Trials</a>  > 
                     <a href="{{ route('clinicalTrialRetention.trial-visit-number', $route_id) }}"> Number of Trial Visits</a> >
                     <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
                </div>
                      <div class="table-details">
                            <table class="table" id="clinical-search">
                                <thead>
                                    <tr>
                                        <th>Visit Number </th>
                                        <th>Site address </th>
                                        <th>Frequency</th>
                                    </tr>
                                </thead>
                                <tr>
                                    @if(isset($vists) && !empty($vists))
                                    @foreach($vists as $vist)
                                <tr>
                                    <td>{{@$vist->visitor_number}}</td>
                                    <td>{{@$vist->researchSite->address. " " .@$vist->researchSite->city. " " .@$vist->researchSite->state. " " .@$vist->researchSite->zipcode}}</td>                           
                                    <td>{{@$vist->frequency}}</td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div class="visit-custom">
                        <h4><strong>Add Additional Visits:</strong></h4>
                        </div>
                        <br>
                        <form method="post" action="{{ route('clinicalTrialRetention.store-trial-visit-number',$clinicaltrials->id) }}">
                            <input type="hidden" value="{{csrf_token()}}" name="_token" />
                            <input type="hidden" name="clinical-id" value="{{$clinicaltrials->id}}" id="clinical-id">
                            
                            <div class="form-group">
                                <label for="visitor_number">Visit Number :</label>
                                <input type="text" class="form-control @error('visitor_number') is-invalid @enderror" name="visitor_number" value="{{ old('visitor_number') }}"/>
                            </div>
                            @error('visitor_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group"> 
                                <label for="research_site_id">Site address:</label>
                                <select  class="form-control" name="research_site_id" >
                                    @foreach($research_sites as $research_site)
                                    <option value="{{ $research_site->id }}"> {{$research_site->address}}, {{$research_site->city}}, {{$research_site->state}}, {{$research_site->zipcode}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('research_site_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="frequency">Frequency:</label>
                                <textarea type="text" class="form-control @error('frequency') is-invalid @enderror" name="frequency" value="{{ old('frequency') }}"></textarea>
                            </div>
                            @error('frequency')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn-typo" name="form1">Add Trial Visit</button>
                        </form>
<!--                     </div> -->
                </div>
<!--             </div> -->
        </div>
    </div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
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
