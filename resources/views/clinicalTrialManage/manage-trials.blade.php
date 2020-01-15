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
                <h1>Manage Clinical Trials</h1>
              </div>
                <div class="table-details">
                        <table class="table" id="clinical-search">
                          <thead>
                            <tr class="list-item">
                              <th scope="col">Name of Clinical Trial</th>
                              <th scope="col">Date of Submission</th>
                              <th scope="col">Enrolled Participants</th>
                              <th scope="col">Status</th>
                              <th scope="col">Retention Management</th>
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
            <input type="hidden" name="clinical-id" value="" id="clinical-id">
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
                <h4>Terms and Conditions</h4>
                <p>ClinicalMatch uses a customized and individualized approach that is tailored to a Participant and the research site. ClinicalMatch will organize appointments and tasks using our proprietary software to track progress and identify retention issues. As an incentive to retaining Participants, ClinicalMatch uses a unique hold-back reimbursement model as a gift to enrolled Participants, ensuring enrolled Participants complete the clinical trial.</p>
                <p>By using ClinicalMatch Retention Services, the Investigator agrees to the following:</p>
                <ul>
                  <li>1.Abide by the Code of Federal Regulations, 45CFR46, governing the protection of human subjects in research and Good clinical practice (GCP) guidelines.</li>
                  <li>2.That all Participant information (protected health information, contact addresses, and contact information of family members, caregivers and the Participant’s health care provider) enrolled in the retention services shall be used for the sole purpose of retaining the participant in your clinical trial.</li>
                  <li>3.Investigator will pay ClinicalMatch $500 for a completed visit.</li>
                  <li>4.Investigator will determine which visits require retention services.</li>
                  <li>5.A visit is said to be completed if the Participant has completed the minimum required procedures for that visit as defined by the study protocol.</li>
                  <li>6.The full amount of the retention fee shall be due and payable upon completion of the minimum procedures of the visit.</li>
                  <li>7.A visit is said to be completed if the Participant has completed the minimum required procedures for that visit as defined by the study protocol.</li>
                  <li>8.A visit is said to be completed if the Participant has completed the minimum required procedures for that visit as defined by the study protocol.</li>
                  <li>8.A visit is said to be completed if the Participant has completed the minimum required procedures for that visit as defined by the study protocol.</li>
                </ul>
              </div>
              <div class="addinital-info">
                 <button class="btn-typo agree-form">AGREE</a>
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
    $('#clinical-search').DataTable({
        "ajax": "{{ url('/') }}/clinical-trial-manage/manage-ajax"
    });
});
</script>
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
<script>
    $(document).on('click','.submit-trial',function(event){
          event.preventDefault();
          var id = $(this).data("id");
          $("#clinical-id").val(id);
          $("#exampleModalCenter").modal("show");
    });
    </script>
    <script>
    $(document).ready(function(){
        $(".agree-form").click(function(){
          var clinical = $("#clinical-id").val();
           $("#view-form-"+clinical).trigger("submit");
        });
    });
    </script>
@endsection
