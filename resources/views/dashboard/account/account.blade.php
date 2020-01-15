@extends('layouts.dashboard-menu')

@section('content')

      <div class="page-container">
          <div class="dashbrd-section">
            <div class="page-title-hdng">
              <h5>My Account</h5>
              <h1>My Clinical Trials</h1>
              <ul>
                <li>
                  <a href="javascript:void(0)" class="active">Clinical Trial Applications</a>
                </li>
                @if((Auth::user()->role_id == '2'))
                <li>
                  <a href="{{ route('account.subinvestigator') }}" >Sub Investigator Applications</a>
                </li>
                @endif
                <li>
                  <a href="{{ route('account.saved') }}" >Saved Trials</a>
                </li>
              </ul>
            </div>
            <div class="clinically-form">
              <div class="table-details application-detail purple-line" >
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
        "ajax": "{{ url('/') }}/account/ajax-clinical"
    });
});
</script>
@endsection
