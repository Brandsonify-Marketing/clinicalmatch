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
                <h5>Clinical Trial Management</h5>
                <h1>Clinical Trial Application Management</h1>
              </div>
              <div class="clinically-form">
                <div class="table-details">
                        <table class="table" id="clinical-manage-search">
                          <thead>
                            <tr class="list-item">
                              <th scope="col">Applicant Name</th>
                              <th scope="col">Posted</th>
                              <th scope="col">Study Interest</th>
                              <th scope="col">Status</th>
                              <th scope="col">Clinical Trial Name</th>
                              <th></th>
                              <!-- <th scope="col">Patient Name</th> -->
                            </tr>
                          </thead>
                        </table>
                </div>
<!--                 <div class="more-detail">
                  <a href="javascript:void(0):" id = "ViewMoreListItem">view more</a>
                </div> -->
              </div>
            </div>
        </div>
      </div>
@endsection

@section('scripts')

<script>
$(document).ready(function () {
    $('#clinical-manage-search').DataTable({
        "ajax": "{{ url('/') }}/clinical-trial-manage/ajax"
    });
});
</script>
@endsection
