@extends('layouts.dashboard-menu')

@section('content')

      <div class="page-container">
          <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>My Clinical Trials</h1>
              <ul>
                <li>
                  <a href="{{ route('account.index') }}">Clinical Trial Applications</a>
                </li>
                @if((Auth::user()->role_id == '2'))
                <li>
                  <a href="javascript:void(0)" class="active">Sub Investigator Applications</a>
                </li>
                @endif
                <li>
                  <a href="{{ route('account.saved') }}" >Saved Trials</a>
                </li>
              </ul>
            </div>
            <div class="clinically-form">
              <div class="table-details application-detail purple-line">
                    <table class="table" id="account-search">
                          <thead>
                            <tr>
                              <th scope="col">Applicant Name</th>
                              <th scope="col">Posted</th>
                              <th scope="col">Study Interest</th>
                              <th scope="col">Status</th>
                              <th scope="col">Clinical Trial Name</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($subinvestigators as $subinvestigator)
                            <tr class="list-item">
                              @if(isset($subinvestigator->user->firstname) && !empty($subinvestigator->user->firstname))
                              <td>{{ $subinvestigator->user->firstname }}</td>
                              @endif
                              @if(isset($subinvestigator->created_at) && !empty($subinvestigator->created_at))
                              <td>{{ \Carbon\Carbon::parse($subinvestigator->created_at)->format('d.m.Y')}}</td>
                              @endif
                              @if(isset($subinvestigator->study_title) && !empty($subinvestigator->study_title))
                              <td>{{ $subinvestigator->study_title }}</td>
                              @endif
                              @if(isset($subinvestigator->status) && !empty($subinvestigator->status))
                                  @if($subinvestigator->status == 1)
                                      <td>Approved</td>
                                  @elseif($subinvestigator->status == 3)
                                      <td>Declined</td>
                                  @else
                                      <td>Pending</td>
                                  @endif
                              @else
                                    <td>Pending</td>
                              @endif
                              @if(isset($subinvestigator->clinicaltrial->study_title) && !empty($subinvestigator->clinicaltrial->study_title))
                              <td>{{ $subinvestigator->clinicaltrial->study_title }}</td>
                              @endif
                              <td><a href="{{ route('account.view-sub-trial',$subinvestigator->id)}}">View</a></td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
              </div>
              <div class="more-detail">
                <a href="javascript:void(0):" id = "ViewMoreListItem">view more</a>
              </div>
            </div>
          </div>
      </div>
      <div class="slide-overlay"></div>
    </div>

@endsection

@section('scripts')

<script>
$(document).ready(function () {
    $('#account-search').DataTable({
        "ajax": "{{ url('/') }}/account/ajax-sub"
    });
});
</script>
@endsection
