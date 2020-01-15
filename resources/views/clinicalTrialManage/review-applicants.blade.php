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
            <h1>Review & Approve Applicants</h1>
        </div>
        @php
        $url_name = url()->current();
        $url = url('/clinical-trial-manage/review-applicants/all');
        $approve = url('/clinical-trial-manage/review-applicants/1');
        $pending = url('/clinical-trial-manage/review-applicants/2');
        $declined = url('/clinical-trial-manage/review-applicants/3');
        @endphp
        <div class="table-tab">
            <ul>
                <li class=<?php if ($url_name == $url) echo "active"; ?>>
                    <a href="{{ route('clinicalTrialManage.review-applicants','all')}}">
                        <label>All Applicants</label>
                    </a>
                </li>
                <li class=<?php if ($url_name == $approve) echo "active"; ?> >
                    <a href="{{ route('clinicalTrialManage.review-applicants','1')}}">
                        <label>Approved Applicants</label>
                    </a>
                </li>
                <li class=<?php if ($url_name == $pending) echo "active"; ?>>
                    <a href="{{ route('clinicalTrialManage.review-applicants','2')}}">
                        <label>Pending Applicants</label>
                    </a>
                </li>
                <li class=<?php if ($url_name == $declined) echo "active"; ?>>
                    <a href="{{ route('clinicalTrialManage.review-applicants','3')}}">
                        <label>Declined Applicants</label>
                    </a>
                </li>
            </ul>
        </div>
        <input type="hidden" name="route_id" value="{{request()->route('status')}}" id="route_id">
        <div class="table-details">
            <table class="table" id="clinical-search">
                <thead>
                    <tr class="list-item">
                        <th scope="col">Applicant Name</th>
                        <th scope="col">Name of Clinical Trial</th>
                        <th scope="col">Date Submitted</th>
                        <th scope="col">Status</th>
                        <th scope="col">Payment</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal syposis-modal fade" id="exampleModalCenterpayapplicant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <input type="hidden" name="pay-applicant-id" value="" id="pay-applicant-id">
            <input type="hidden" name="clinical-id" value="" id="clinical-id">
            <input type="hidden" name="service_title" value="{{ setting('payment.enrollment_services_title') }}" id="service_title">
            <input type="hidden" name="service_cost" value="{{ setting('payment.enrollment_services_cost') }}" id="service_cost">
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
              <div class="modal-txt">
                <h4>Payment</h4>
                <div class="text-center">
                <p><strong>You will be charged ${{ setting('payment.enrollment_services_cost')/100 }} for this applicant!</strong></p>
              </div>
              </div>
              <br>
              <div class="addinital-info">
                 <button class="btn-typo agree-form-pay-applicant">PAY NOW</button>
                 <span class="button" data-dismiss="modal" aria-label="Close"><button class="btn-typo">Cancel</button></span> 
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
    var route_id = $("#route_id").val();
    console.log(route_id);
    $(document).ready(function () {
        $('#clinical-search').DataTable({
            "ajax": "{{ url('/clinical-trial-manage/review-applicants-ajax')}}"+'/'+route_id,
        });
    });
</script>
<script>
    $(document).on('click','.submit-trial-pay-applicant',function(event){
          event.preventDefault();
          var id = $(this).data("id");
          var clinical = $(this).data("clinical"); 
          $("#clinical-id").val(clinical);
          $("#pay-applicant-id").val(id);
          $("#exampleModalCenterpayapplicant").modal("show");
    });
    </script>
    <script>
    $(document).ready(function(){
        $(".agree-form-pay-applicant").click(function(){
          var payapplicant = $("#pay-applicant-id").val();
          var clinicalpay = $("#clinical-id").val();
           $("#view-form-pay-applicant"+payapplicant+clinicalpay).trigger("submit");
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
      url: "{{ url('clinical-trial-manage/participant-detail')}}"+'/'+id,
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
