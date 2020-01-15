@extends('layouts.dashboard-menu')

@section('content')

        <div class="page-container">
            <div class="dashbrd-section">
              <div class="page-title-hdng">
                <h5>Clinical Trial Management</h5>
                <h1>Review & Approve Sub-Investigator Applications</h1>
              </div>
              <div class="clinically-form">
                <div class="table-details blue-line">
                        <table class="table" id="clinical-manage-search">
                          <thead>
                            <tr class="list-item">
                              <th scope="col">Applicant Name</th>
                              <th scope="col">Submission Date</th>
                              <th scope="col">Study of Interest</th>
                              <th scope="col">Clinical Trial Name</th>
                              <th scope="col">Status</th>
                              <!-- <th scope="col">Patient Name</th> -->
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
      </div>
      <div class="modal syposis-modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <input type="hidden" name="user_id" id="user_id" value="">
              <input type="hidden" name="clinical_ids" value="{{request()->route('id')}}" id="clinical_ids">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="modal-logo text-center">
                  <a href="#">
                    <img src="{{ asset('images/logo.png')}}">
                  </a>
                </div>
                <div class="patient-details" id="patient-details">
                </div>
              </div>
            </div>
          </div>
  </div>
@endsection
@section('scripts')

<script>
$(document).ready(function () {
    $('#clinical-manage-search').DataTable({
        "ajax": "{{ url('/') }}/clinical-trial-manage/sub-ajax"
    });
});
</script>

<script>
$(document).on('click','.submit-trial-inv',function(event){
      event.preventDefault();
      var id = $(this).data("id");
      $("#exampleModalCenter").modal("show");  
      $.ajax({
      type: 'get',
      url: "{{ url('clinical-trial-manage/investigator-detail')}}"+'/'+id,
      success: function(data) {
          if ((data.errors)) {
              $('.error').removeClass('hidden');
              $('.error').text(data.errors.message);
          } else {
              console.log(data);
              $('.error').remove();
              $('#patient-details').html(data);
          }
      },
      });    

});
</script>
@endsection
