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
            <h1>Patient Visit Management</h1>
        </div>
        <div class="table-details">
            <table class="table custom-visit" id="clinical-search">
                <thead>
                    <tr class="list-item" id="users-crud">
                        <th scope="col">Patient Name</th>
                        <th scope="col">Clinical Trial</th>
                        <th scope="col">Completed Visits</th>
                        <th scope="col">Scheduled Visits</th>
                        <th scope="col">Pending Visits</th>
                        <th scope="col">Total Visits</th>
                    </tr>
                </thead>
            </table>
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
<div class="modal syposis-modal fade" id="exampleModalCentertrial" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <div class="trial-details" id="trial-details">
                </div>
              </div>
            </div>
          </div>
  </div>
<div class="modal syposis-modal fade" id="exampleModalCentercomplete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <div class="complete-details" id="complete-details">
                </div>
              </div>
            </div>
          </div>
  </div>

 <div class="modal syposis-modal fade" id="exampleModalCenterscheduled" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <div class="scheduled-details" id="scheduled-details">
                </div>
              </div>
            </div>
          </div>
  </div>
@endsection
@section('scripts')
<script>
$(document).on('click','.submit-trial-complete',function(event){
      event.preventDefault();
      var id = $(this).data("id");
      $("#exampleModalCentercomplete").modal("show");  
      $.ajax({
      type: 'get',
      url: "{{ url('clinical-trial-retention/complete-visit-details')}}"+'/'+id,
      success: function(data) {
          if ((data.errors)) {
              $('.error').removeClass('hidden');
              $('.error').text(data.errors.message);
          } else {
              console.log(data);
              $('.error').remove();
              $('#complete-details').html(data);
          }
      },
      });    

});
</script>

<script>
$(document).on('click','.submit-trial-scheduled',function(event){
      event.preventDefault();
      var id = $(this).data("id");
      $("#exampleModalCenterscheduled").modal("show");  
      $.ajax({
      type: 'get',
      url: "{{ url('clinical-trial-retention/scheduled-visit-details')}}"+'/'+id,
      success: function(data) {
          if ((data.errors)) {
              $('.error').removeClass('hidden');
              $('.error').text(data.errors.message);
          } else {
              console.log(data);
              $('.error').remove();
              $('#scheduled-details').html(data);
          }
      },
      });    

});
</script>

<script>
$(document).on('click','.submit-trial',function(event){
      event.preventDefault();
      var id = $(this).data("id");
      $("#exampleModalCenter").modal("show");  
      $.ajax({
      type: 'get',
      url: "{{ url('clinical-trial-retention/participant-detail')}}"+'/'+id,
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

<script>
$(document).on('click','.submit-trial-visit',function(event){
      event.preventDefault();
      var id = $(this).data("id");
      $("#exampleModalCentertrial").modal("show");  
      $.ajax({
      type: 'get',
      url: "{{ url('clinical-trial-retention/trial-detail')}}"+'/'+id,
      success: function(data) {
          if ((data.errors)) {
              $('.error').removeClass('hidden');
              $('.error').text(data.errors.message);
          } else {
              console.log(data);
              $('.error').remove();
              $('#trial-details').html(data);
          }
      },
      });    

});
</script>

<script>
    $(document).on('click','.submit-trial-pay',function(event){
          event.preventDefault();
          var id = $(this).data("id");
          $("#pay-id").val(id);
          $("#exampleModalCenterpay").modal("show");
    });
    </script>
    <script>
    $(document).ready(function(){
        $(".agree-form-pay").click(function(){
          var pay = $("#pay-id").val();
           $("#view-form-pay"+pay).trigger("submit");
        });
    });
    </script>

<script>
    $(document).ready(function () {
        $('#clinical-search').DataTable({
            "ajax": "{{ url('/') }}/clinical-trial-retention/patient-visit-ajax",
        });
    });
</script>
@endsection
