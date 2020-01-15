@extends('layouts.dashboard-menu')

@section('content')

<div class="page-container">
    @if(\Session::has('success'))
    <div class="alert alert-success w-100">
        {{\Session::get('success')}}
    </div>
    @endif
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>Clinical Trial Management</h5>
            <h1>Review & Approve Clinical Trials</h1>
        </div>
        @php
        $url_name = url()->current();
        $url = url('/clinical-trial-manage/review/all');
        $approve = url('/clinical-trial-manage/review/1');
        $pending = url('/clinical-trial-manage/review/2');
        $declined = url('/clinical-trial-manage/review/3');
        @endphp
        <div class="clinically-form">
            <div class="table-tab">
                <ul>
                    <li class=<?php if ($url_name == $url) echo "active"; ?>>
                        <a href="{{ route('clinicalTrialManage.review','all')}}">
                            <label>All Trials</label>
                        </a>
                    </li>
                    <li class=<?php if ($url_name == $approve) echo "active"; ?>>
                        <a href="{{ route('clinicalTrialManage.review','1')}}">
                            <label>Approved Trials</label>
                        </a>
                    </li>
                    <li class=<?php if ($url_name == $pending) echo "active"; ?>>
                        <a href="{{ route('clinicalTrialManage.review','2')}}">
                            <label>Pending Trials</label>
                        </a>
                    </li>
                    <li class=<?php if ($url_name == $declined) echo "active"; ?>>
                        <a href="{{ route('clinicalTrialManage.review','3')}}">
                            <label>Declined Trials</label>
                        </a>
                    </li>
                </ul>
            </div>
            <input type="hidden" name="route_id" value="{{request()->route('status')}}" id="route_id">
            <div class="table-details">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name of Clinical Trial</th>
                            <th scope="col">Submission Date</th>
                            <th scope="col">Form Type</th>
                            <th scope="col">Download</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clinicaltrials as $clinicaltrial)
                        <tr class="list-item">
                            <td data-label="Name of Clinical Trial"><a href="{{ route('clinicalTrialRetention.trial-detail', $clinicaltrial->id) }}" data-id={{$clinicaltrial->id}} class="submit-trial-detail">{{ $clinicaltrial->study_title}}</a></td>
                            <td data-label="Submission Date: ">{{ \Carbon\Carbon::parse($clinicaltrial->created_at)->format('m/d/Y')}}</td>
                            <td data-label="Form Type">                
                                @if($clinicaltrial->form_type == 1)
                                IRB 
                                @else
                                NON IRB
                                @endif</td>
                            <td><a href="{{ route('clinicalTrialManage.download-pdf', $clinicaltrial->id) }}">Download</a></td>
                            <td><a href="{{ route('clinicalTrialManage.review-trial', $clinicaltrial->id) }}"> @if($clinicaltrial->status == 1)
                            Approved
                                @elseif($clinicaltrial->status == 2)
                            Pending
                                @elseif($clinicaltrial->status == 3)
                            Declined
                            @else
                            Review & Approve
                                @endif
                                </a>
                            </td>
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
                <div class="patient-details" id="patient-details">
                </div>
              </div>
            </div>
          </div>
  </div>
@endsection
@section('scripts')
<script>
$(document).on('click','.submit-trial-detail',function(event){
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
              $('#patient-details').html(data);
          }
      },
      });    

});
</script>
@endsection
