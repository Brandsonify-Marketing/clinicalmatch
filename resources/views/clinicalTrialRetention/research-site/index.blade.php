@extends('layouts.dashboard-menu')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@section('content')

<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h1>Research Sites</h1>
        </div>
        <div class="clinically-form">
            @if(\Session::has('success'))
            <div class="alert alert-success w-100">
                {{\Session::get('success')}}
            </div>
            @endif
            <div class="containers">
                 <div class="submit-paymnt back-btn">
                  <a href="{{ route('clinicalTrialRetention.enrolled') }}">Back</a>
                </div>
                <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
                    @php
                    $route_id = request()->route('id');
                    $trial_name = App\ClinicalTrial::where('id', $route_id)->first();
                    @endphp
                     <a href="{{ route('clinicalTrialRetention.enrolled') }}">Manage Enrolled Clinical Trials</a>  > 
                     <a href="{{ route('clinicalTrialRetention.research-site', $route_id) }}"> Research Sites</a>  >
                     <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
                </div>
                <div class="tab-content">
                    <div id="patients" class="containers tab-pane active"><br>

                        <div class="table-details">
                            <table class="table" id="clinical-search">
                                <thead>
                                    <tr>
                                        <th>Site Number </th>
                                        <th>Site address </th>
                                        <th>Contact Name </th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tr>
                                    @if(isset($retentionslocations) && !empty($retentionslocations))
                                    @foreach($retentionslocations as $retentionslocation)
                                <tr>
                                    <td>{{$retentionslocation->site_number}}</td>
                                    <td>{{$retentionslocation->address}}, {{$retentionslocation->city}}, {{$retentionslocation->state}}, {{$retentionslocation->zipcode}}</td>
                                    <td>{{$retentionslocation->contact_name}}</td>
                                    <td>{{$retentionslocation->contact_email}}</td>
                                    <td>{{$retentionslocation->contact_phone}}</td>
                                    <td><a href="{{route('clinicalTrialRetention.edit-research-sites', $retentionslocation->id) }}">Update Location</a></td>
                                    <td>
                                    <form action="{{action('ClinicalRetentionController@deleteSite', $retentionslocation->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    </td>
<!--                                    <td>
                                        <form action="{{action('ClinicalRetentionController@deleteLocation', $retentionslocation->id)}}" method="post">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>-->
                                </tr>
                                @endforeach
                                @endif
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div class="visit-custom">
                        <h4><strong>Add Additional Sites:</strong></h4>
                        </div>
                        <br>
                        <form method="post" action="{{ route('clinicalTrialRetention.store-research-sites',$clinicaltrials->id) }}">
                            <input type="hidden" value="{{csrf_token()}}" name="_token" />
                            <input type="hidden" name="clinical-id" value="{{$clinicaltrials->id}}" id="clinical-id">
                            <div class="form-group">
                                <label for="address">Site address:</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"/>
                            </div>
                            @error('private_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}"/>
                            </div>
                            @error('private_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="state">State:</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}"/>
                            </div>
                            @error('private_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="zipcode">Zip Code:</label>
                                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}"/>
                            </div>
                            @error('private_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="contact_name">Contact Name:</label>
                                <input type="text" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" value="{{ old('contact_name') }}"/>
                            </div>
                            @error('private_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="contact_email">Email:</label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" name="contact_email" value="{{ old('contact_email') }}"/>
                            </div>
                            @error('private_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <label for="contact_phone">Phone:</label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" name="contact_phone" value="{{ old('contact_phone') }}"/>
                            </div>
                            @error('private_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn-typo" name="form1">Add Location</button>
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
<script>
//    $(document).ready(function () {
//        if (location.hash) {
//            $('a[href=\'' + location.hash + '\']').tab('show');
//        }
//        var activeTab = localStorage.getItem('activeTab');
//        if (activeTab) {
//            $('a[href="' + activeTab + '"]').tab('show');
//        }
//
//        $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
//            e.preventDefault()
//            var tab_name = this.getAttribute('href')
//            if (history.pushState) {
//                history.pushState(null, null, tab_name)
//            } else {
//                location.hash = tab_name
//            }
//            localStorage.setItem('activeTab', tab_name)
//
//            $(this).tab('show');
//            return false;
//        });
//        $(window).on('popstate', function () {
//            var anchor = location.hash ||
//                    $('a[data-toggle=\'tab\']').first().attr('href');
//            $('a[href=\'' + anchor + '\']').tab('show');
//        });
//    });
</script>
@endsection
@section('scripts')
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
          $('.date').datepicker({
              format: "dd-mm-yyyy",
              startDate: "+0d"
          });
</script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>-->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
          $('.timepicker').datetimepicker({
              format: 'HH:mm:ss'
          });
</script>-->
@endsection
