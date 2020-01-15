@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
    @if ($errors->any())
    <div class="alert alert-danger w-100">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br />
    @endif
    @if(\Session::has('success'))
            <div class="alert alert-success w-100">
                {{\Session::get('success')}}
            </div>
    @endif
    @php
    $route_id = request()->route('id');
    @endphp

    <div class="dashbrd-section">
      <div class="page-title-hdng">
        <h5>Find a Clinical Trial</h5>
        <h1>Sub-Investigator Application</h1>
      </div>
      <div class="clinically-form">
        <h3>Apply to become a Sub-Investigator</h3>
                <div class="submit-paymnt back-btn">
          <a href="{{ route('clinicalTrial.view',$route_id) }}">Back To Clinical Trial</a>  
       </div>
      <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
            @php
            $route_id = request()->route('id');
            $trial_name = App\ClinicalTrial::where('id', $route_id)->first();
            @endphp
             <a href="{{ route('clinicalTrial.index') }}">Find a Clinical Trial</a>  > 
             <a href="{{ route('clinicalTrial.view', $route_id) }}"> View Trial</a>  >
             <a href="{{ route('clinicalTrial.apply-sub-investigator', $route_id) }}"> Apply to become a SubInvestigator</a>  >
             <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
        </div>
        <br>
        <form method="post" action="{{ route('clinicalTrial.applied-sub-investigator',$clinicaltrial->id)}}">
          @csrf
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <div class="row">
            <div class="col-12 col-md-6 form-fields">
              <label>Full Title of Study</label>
              <input type="text" class="form-control @error('study_title') is-invalid @enderror" id="study_title" name="study_title" value="{{ old('study_title') }}"  autocomplete="study_title" autofocus>
              @error('study_title')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 col-md-6 form-fields">
              <label>Research Site Name</label>
              <input type="text" class="form-control @error('site_name') is-invalid @enderror" name="site_name" value="{{ old('site_name') }}" autocomplete="site_name" autofocus>
              @error('site_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 col-md-6 form-fields">
              <label>Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
              @error('address')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 col-md-4 form-fields">
              <label>City</label>
              <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
              @error('city')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 col-md-2 form-fields">
              <label>State</label>
              <div class="select-box" >
                <select name="state">
                        <option selected="selected" disabled>State</option> 
                        <option value="Alabama" @if (old('state') == "Alabama") {{ 'selected' }} @endif>Alabama</option>
                        <option value="Alaska" @if (old('state') == "Alaska") {{ 'selected' }} @endif>Alaska</option>
                        <option value="Arizona" @if (old('state') == "Arizona") {{ 'selected' }} @endif>Arizona</option>
                        <option value="Arkansas" @if (old('state') == "Arkansas") {{ 'selected' }} @endif>Arkansas</option>
                        <option value="California" @if (old('state') == "California") {{ 'selected' }} @endif>California</option>
                        <option value="Colorado" @if (old('Colorado') == "Colorado") {{ 'selected' }} @endif>Colorado</option>
                        <option value="Connecticut" @if (old('state') == "Connecticut") {{ 'selected' }} @endif>Connecticut</option>
                        <option value="Delaware" @if (old('state') == "Delaware") {{ 'selected' }} @endif>Delaware</option>
                        <option value="District Of Columbia" @if (old('state') == "District Of Columbia") {{ 'selected' }} @endif>District Of Columbia</option>
                        <option value="Florida" @if (old('state') == "Florida") {{ 'selected' }} @endif>Florida</option>
                        <option value="Georgia" @if (old('state') == "Georgia") {{ 'selected' }} @endif>Georgia</option>
                        <option value="Hawaii" @if (old('state') == "Hawaii") {{ 'selected' }} @endif>Hawaii</option>
                        <option value="Idaho" @if (old('state') == "Idaho") {{ 'selected' }} @endif>Idaho</option>
                        <option value="Illinois" @if (old('state') == "Illinois") {{ 'selected' }} @endif>Illinois</option>
                        <option value="Indiana" @if (old('state') == "Indiana") {{ 'selected' }} @endif>Indiana</option>
                        <option value="Iowa" @if (old('state') == "Iowa") {{ 'selected' }} @endif>Iowa</option>
                        <option value="Kansas" @if (old('state') == "Kansas") {{ 'selected' }} @endif>Kansas</option>
                        <option value="Kentucky" @if (old('state') == "Kentucky") {{ 'selected' }} @endif>Kentucky</option>
                        <option value="Louisiana" @if (old('state') == "Louisiana") {{ 'selected' }} @endif>Louisiana</option>
                        <option value="Maine" @if (old('state') == "Maine") {{ 'selected' }} @endif>Maine</option>
                        <option value="Maryland" @if (old('state') == "Maryland") {{ 'selected' }} @endif>Maryland</option>
                        <option value="Massachusetts" @if (old('state') == "Massachusetts") {{ 'selected' }} @endif>Massachusetts</option>
                        <option value="Michigan" @if (old('state') == "Michigan") {{ 'selected' }} @endif>Michigan</option>
                        <option value="Minnesota" @if (old('state') == "Minnesota") {{ 'selected' }} @endif>Minnesota</option>
                        <option value="Mississippi" @if (old('state') == "Mississippi") {{ 'selected' }} @endif>Mississippi</option>
                        <option value="Missouri" @if (old('state') == "Missouri") {{ 'selected' }} @endif>Missouri</option>
                        <option value="Montana" @if (old('state') == "Montana") {{ 'selected' }} @endif>Montana</option>
                        <option value="Nebraska" @if (old('state') == "Nebraska") {{ 'selected' }} @endif>Nebraska</option>
                        <option value="Nevada" @if (old('state') == "Nevada") {{ 'selected' }} @endif>Nevada</option>
                        <option value="New Hampshire" @if (old('state') == "New Hampshire") {{ 'selected' }} @endif>New Hampshire</option>
                        <option value="New Jersey" @if (old('state') == "AL") {{ 'selected' }} @endif>New Jersey</option>
                        <option value="New Mexico" @if (old('state') == "AL") {{ 'selected' }} @endif>New Mexico</option>
                        <option value="New York" @if (old('state') == "New York") {{ 'selected' }} @endif>New York</option>
                        <option value="North Carolina" @if (old('state') == "North Carolina") {{ 'selected' }} @endif>North Carolina</option>
                        <option value="North Dakota" @if (old('state') == "North Dakota") {{ 'selected' }} @endif>North Dakota</option>
                        <option value="Ohio" @if (old('state') == "Ohio") {{ 'selected' }} @endif>Ohio</option>
                        <option value="Oklahoma" @if (old('state') == "Oklahoma") {{ 'selected' }} @endif>Oklahoma</option>
                        <option value="Oregon" @if (old('state') == "Oregon") {{ 'selected' }} @endif>Oregon</option>
                        <option value="Pennsylvania" @if (old('state') == "Pennsylvania") {{ 'selected' }} @endif>Pennsylvania</option>
                        <option value="Rhode Island" @if (old('state') == "Rhode Island") {{ 'selected' }} @endif>Rhode Island</option>
                        <option value="South Carolina" @if (old('state') == "South Carolina") {{ 'selected' }} @endif>South Carolina</option>
                        <option value="South Dakota" @if (old('state') == "South Dakota") {{ 'selected' }} @endif>South Dakota</option>
                        <option value="Tennessee" @if (old('state') == "Tennessee") {{ 'selected' }} @endif>Tennessee</option>
                        <option value="Texas" @if (old('state') == "Texas") {{ 'selected' }} @endif>Texas</option>
                        <option value="Utah" @if (old('state') == "Utah") {{ 'selected' }} @endif>Utah</option>
                        <option value="Vermont" @if (old('state') == "Vermont") {{ 'selected' }} @endif>Vermont</option>
                        <option value="Virginia" @if (old('state') == "Virginia") {{ 'selected' }} @endif>Virginia</option>
                        <option value="Washington" @if (old('state') == "Washington") {{ 'selected' }} @endif>Washington</option>
                        <option value="West Virginia" @if (old('state') == "West Virginia") {{ 'selected' }} @endif>West Virginia</option>
                        <option value="Wisconsin" @if (old('state') == "Wisconsin") {{ 'selected' }} @endif>Wisconsin</option>
                        <option value="Wyoming" @if (old('state') == "Wyoming") {{ 'selected' }} @endif>Wyoming</option>
                        <option value="American Samoa" @if (old('state') == "American Samoa") {{ 'selected' }} @endif>American Samoa</option>
                        <option value="Guam" @if (old('state') == "Guam") {{ 'selected' }} @endif>Guam</option>
                        <option value="Northern Mariana Islands" @if (old('state') == "Northern Mariana Islands") {{ 'selected' }} @endif>Northern Mariana Islands</option>
                        <option value="Puerto Rico" @if (old('state') == "Puerto Rico") {{ 'selected' }} @endif>Puerto Rico</option>
                        <option value="United States Minor Outlying Islands" @if (old('state') == "United States Minor Outlying Islands") {{ 'selected' }} @endif>United States Minor Outlying Islands</option>
                        <option value="Virgin Islands" @if (old('state') == "Virgin Islands") {{ 'selected' }} @endif>Virgin Islands</option>
                        <option value="Armed Forces Americas" @if (old('state') == "Armed Forces Americas") {{ 'selected' }} @endif>Armed Forces Americas</option>
                        <option value="Armed Forces Pacific" @if (old('state') == "Armed Forces Pacific") {{ 'selected' }} @endif>Armed Forces Pacific</option>
                        <option value="Armed Forces Others" @if (old('state') == "Armed Forces Others") {{ 'selected' }} @endif>Armed Forces Others</option> 
                </select>
              </div>
              @error('state')
              <span class="invalid-feedback" role="alert">
                  <strong style="color:red">{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 form-fields">
              <label>Mechanism of drug/device</label>
              <input type="text" class="form-control @error('mechanism') is-invalid @enderror" name="mechanism" value="{{ old('mechanism') }}" required autocomplete="mechanism" autofocus>
              @error('mechanism')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-12 form-fields">
                  <label>List of participation benefits</label>
                  <textarea type="text" class="form-control @error('list_benefits') is-invalid @enderror" id="list_benefits" name="list_benefits">{{ old('list_benefits') }}</textarea>
                </div>
            <div class="col-12 text-center text-md-right">
              {{-- <input type="button" value="submit" id="submitbtn" class="btn-typo" name="btn" data-toggle="modal" data-target="#review-modal"> --}}
              <input type="submit" value="submit" class="btn-typo" name=""  data-toggle="modal" data-target="#review-modal">
            </div>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection
