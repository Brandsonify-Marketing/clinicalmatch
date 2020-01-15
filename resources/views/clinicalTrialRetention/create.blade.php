@extends('layouts.dashboard-menu')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@section('content')

<div class="page-container">
        <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h1>Trial Retention</h1>
            </div>
            <div class="clinically-form">
               @if(\Session::has('success'))
                <div class="alert alert-success w-100">
                    {{\Session::get('success')}}
                </div>
                @endif
                <div class="containers">
                        <br>
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#patients">Patients</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#locations">Locations</a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div id="patients" class="containers tab-pane active"><br>
                            <div class="table-details">
                                    <table class="table" id="clinical-search">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            @if(isset($retentionspatients) && !empty($retentionspatients))
                                            @foreach($retentionspatients as $retentionspatient)
                                            <tr>
                                                <td>{{$retentionspatient->name}}</td>
                                                <td>{{$retentionspatient->email}}</td>
                                                <td>{{$retentionspatient->phone}}</td>
                                                <td>
                                        <form action="{{action('ClinicalRetentionController@deletePatient', $retentionspatient->id)}}" method="post">
                                                {{csrf_field()}}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                            </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tr>
                                    </table>
                                   </div>
                               <form method="post" action="{{ route('clinicalTrialRetention.store',$clinicaltrials->id) }}">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                                    <input type="hidden" name="clinical-id" value="{{$clinicaltrials->id}}" id="clinical-id">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name"/>
                                    </div>
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email"/>
                                    </div>
                                 @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="text" maxlength="10" class="form-control @error('phone') is-invalid @enderror" onkeypress="return isNumberKey(this, event);" value="{{ old('phone') }}" name="phone"/>
                                    </div>
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                    <button type="submit" class="btn-typo" name="form2">Add Patient Detail</button>
                                </form>
                          </div>
                          <div id="locations" class="container tab-pane fade"><br>
                            <div class="table-details">
                                    <table class="table" id="clinical-search">
                                        <thead>
                                            <tr>
                                                <th>Location</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            @if(isset($retentionslocations) && !empty($retentionslocations))
                                            @foreach($retentionslocations as $retentionslocation)
                                            <tr>
                                                <td>{{$retentionslocation->location}}</td>
                                                <td>{{$retentionslocation->date}}</td>
                                                <td>{{$retentionslocation->time}}</td>
                                        <td>
                                        <form action="{{action('ClinicalRetentionController@deleteLocation', $retentionslocation->id)}}" method="post">
                                                {{csrf_field()}}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                            </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tr>
                                    </table>
                                   </div>
                                  <form method="post" action="{{ route('clinicalTrialRetention.store',$clinicaltrials->id) }}">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                                    <input type="hidden" name="clinical-id" value="{{$clinicaltrials->id}}" id="clinical-id">
                                    <div class="form-group">
                                        <label for="location">Location:</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}"/>
                                    </div>
                                  @error('private_name')
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
            if (txt.value.indexOf('.') === - 1) {
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
        $(document).ready(function () {
        if (location.hash) {
                $('a[href=\'' + location.hash + '\']').tab('show');
                }
                var activeTab = localStorage.getItem('activeTab');
                if (activeTab) {
                $('a[href="' + activeTab + '"]').tab('show');
                }

                $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
                e.preventDefault()
                var tab_name = this.getAttribute('href')
                if (history.pushState) {
                    history.pushState(null, null, tab_name)
                }
                else {
                    location.hash = tab_name
                }
                localStorage.setItem('activeTab', tab_name)

                $(this).tab('show');
                return false;
                });
                $(window).on('popstate', function () {
                var anchor = location.hash ||
                    $('a[data-toggle=\'tab\']').first().attr('href');
                $('a[href=\'' + anchor + '\']').tab('show');
                });
        });
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
