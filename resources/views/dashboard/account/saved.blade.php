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
            <a href="{{ route('account.subinvestigator') }}">Sub Investigator Applications</a>
          </li>
          @endif
          <li>
            <a href="javascript:void(0)" class="active">Saved Trials</a>
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
                        <th scope="col">Clinical Trial Name</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($savedtrials as $savedtrial)
                      <tr class="list-item">
                        @if(isset($savedtrial->user->firstname) && !empty($savedtrial->user->firstname))
                        <td>{{ $savedtrial->user->firstname }}</td>
                        @endif
                        @if(isset($savedtrial->created_at) && !empty($savedtrial->created_at))
                        <td>{{ \Carbon\Carbon::parse($savedtrial->created_at)->format('d.m.Y')}}</td>
                        @endif
                        @if(isset($savedtrial->clinicaltrial->study_title) && !empty($savedtrial->clinicaltrial->study_title))
                        <td>{{ $savedtrial->clinicaltrial->study_title }}</td>
                        @endif
                        <td><a href="{{ route('account.view-saved-trial',$savedtrial->id)}}">View</a></td>
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
        "ajax": "{{ url('/') }}/account/ajax-saved"
    });
});
</script>
@endsection
