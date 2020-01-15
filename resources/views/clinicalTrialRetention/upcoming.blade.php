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
                <h5></h5>
                <h1>Upcoming Visits</h1>
              </div>
                <div class="table-details">
                        <table class="table" id="clinical-search">
                          <thead>
                            <tr class="list-item">
                              <th scope="col">Name of Clinical Trial</th>
                              <th scope="col">Location</th>
                              <th scope="col">Date</th>
                              <th scope="col">Time</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tr>
                            @foreach($retentionslocations as $retentionslocation)
                            <tr>
                              <td data-label="Name of Clinical Trial">{{ $retentionslocation->clinicaltrial->study_title }}</td>
                              <td data-label="Location">{{ $retentionslocation->location }}</td>
                              <td data-label="Date">{{ $retentionslocation->date }}</td>
                              <td data-label="Time">{{ $retentionslocation->time }}</td>
                              <td><a href="{{ route('clinicalTrialRetention.upcoming-trial',$retentionslocation->clinicaltrial->id) }}">View</a></td>
                            </tr>
                            @endforeach
                          </tr>
                        </table>
                </div>
              </div>
            </div>
        </div>
      </div>
@endsection