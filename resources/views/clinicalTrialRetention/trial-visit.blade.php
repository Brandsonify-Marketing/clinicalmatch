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
            <h1>Manage Clinical Trial Visits</h1>
        </div>
        <div class="create-btn ">
            <a href="javascript:void(0)" id="create-new-user" class="btn-typo"><strong>Create</strong></a>
        </div>
        <div class="table-details">
            <table class="table custom-visit" id="clinical-search">
                <thead>
                    <tr class="list-item" id="users-crud">
                        <th scope="col">Participant Name </th>
                        <th scope="col">Name of Clinical Trial</th>
                        <th scope="col">Research Site Address</th>
                        <th scope="col">Date & Time of Visit</th>
                        <th scope="col">Visit Status</th>
                        <th scope="col">Case Notes</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Update Details</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal syposis-modal fade" id="ajax-crud-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
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
                    <h4 id="model-heading">Add Trial Visit</h4>
                    <form id="userForm" name="userForm" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <input type="hidden" name="service_title" value="{{ setting('payment.enrollment_services_title') }}" id="service_title">
                            <input type="hidden" name="service_cost" value="{{ setting('payment.enrollment_services_cost') }}" id="service_cost">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="clinical_id"><strong>Clinical Research:</strong></label>
                                        @php
                                        if(Auth::user()->role_id == 8){
                                        $clinicaltrials = App\ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get();
                                        }else{
                                        $clinicaltrials = App\ClinicalTrial::where('user_id', Auth::user()->id)->where('status', 1)->orderby('id', 'DESC')->get();
                                        }
                                        @endphp
                                        <select name="clinical_id" class="form-control clinical_trial_select">
                                            <option value=""> Select Trial</option>
                                            @foreach($clinicaltrials as $k => $clinicaltrial)
                                            <option value="{{ $clinicaltrial->id }}">{{ $clinicaltrial->study_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="research_site_id"><strong>Research Site:</strong></label>
                                        <!--                          @php
                                                                  $researchSites = App\ResearchSite::all();
                                                                  @endphp-->
                                        <select id="research_site_id" name="research_site_id" class="form-control">
                                            <option selected="selected" disabled>--Research Site--</option> 
                                            <!--                                        @foreach($researchSites as $k => $researchSite)
                                            
                                                                                    <option value="{{ $researchSite->id }}">{{ $researchSite->address.", ".$researchSite->state.", ".$researchSite->city.", ".$researchSite->zipcode }}</option>
                                            
                                                                                    @endforeach-->

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="visit_name"><strong>Visit Name:</strong></label>
                                        <input type="text" class="form-control" id="visit_name" name="visit_name" placeholder="Visit Name" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="patient_id"><strong>Patient Name:</strong></label>
                                        <!--                          @php
                                                                  $patient_names = App\User::whereIn('role_id', [2, 3,4])->orderby('id', 'DESC')->get();
                                                                  @endphp-->
                                        <select id="patient_id" name="patient_id" class="form-control">
                                            <option selected="selected" disabled>--Patient Name--</option> 

                                            <!--                                        @foreach($patient_names as $k => $patient_name)
                                            
                                                                                    <option value="{{ $patient_name->id }}">{{ $patient_name->firstname}}</option>
                                            
                                                                                    @endforeach-->

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date"><strong>Date:</strong></label>
                                        <input type="text" class="dater form-control" id="date" name="date" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time"><strong>Time:</strong></label>
                                        <input type="text" class="timepicker form-control" onkeydown="return false" id="time" name="time" placeholder="Time" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status"><strong>Status:</strong></label>
                                        <select name="status" class="form-control">
                                            <option value="1"> Upcoming </option>
                                            <option value="2"> Completed </option>
                                            <option value="3"> Canceled </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="case_note"><strong>Case Notes:</strong></label>
                                        <textarea type="text" class="form-control" id="case_note" name="case_note" placeholder="Case Note" value="" maxlength="50" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="addinital-info">
                            <button type="submit" id="btn-save" class="btn-typo agree-form" value="create">
                                Save Trials Details
                            </button>
                        </div>
                    </form>
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

<div class="modal syposis-modal fade" id="exampleModalCenterpay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <input type="hidden" name="visit-id" value="" id="visit-id">
            <input type="hidden" name="clinical-id" value="" id="clinical-id">
            <input type="hidden" name="service_title" value="{{ setting('payment.retention_services_title') }}" id="service_title">
            <input type="hidden" name="service_cost" value="{{ setting('payment.retention_services_cost') }}" id="service_cost">
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
                        <p><strong>You will be charged ${{ setting('payment.retention_services_cost')/100 }} for this completed visit!</strong></p>
                    </div>
                </div>
                <br>
                <div class="addinital-info">
                    <button class="btn-typo agree-form-pay">PAY NOW</button>
                    <span class="button" data-dismiss="modal" aria-label="Close"><button class="btn-typo">Cancel</button></span> 
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
@endsection
@section('scripts')
<script>
    // GET research site and Patient on change of clinical Trial
    $(document).on('change', '.clinical_trial_select', function () {
        var clinicalTrialId = this.value;
//      research_sites
        $.ajax({
            type: 'get',
            url: "{{ url('clinical-trial/trial-info')}}" + '/' + clinicalTrialId,
            success: function (data) {

                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.message);
                } else {
                    var obj = JSON.parse(data)
                    $('#research_site_id').find('option')
                            .remove()
                            .end();
                    $('#patient_id').find('option')
                            .remove()
                            .end();
                    $.each(obj.research_site, function (key, value) {
                        console.log(value);
                        $('#research_site_id')
                                .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.address + ', ' + value.state + ', ' + value.city + ', ' + value.zipcode));
                    });
                    $.each(obj.patients, function (key, value) {
                        console.log(value);
                        $('#patient_id')
                                .append($("<option></option>")
                                        .attr("value", value.user_id)
                                        .text(value.name));
                    });

//              $('.error').remove();
//              $('#trial-details').html(data);
                }
            },
        });

    });
</script>
<script>
    $(document).on('click', '.submit-trial-visit', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $("#exampleModalCentertrial").modal("show");
        $.ajax({
            type: 'get',
            url: "{{ url('clinical-trial-retention/trial-detail')}}" + '/' + id,
            success: function (data) {
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
    $(document).on('click', '.submit-trial', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $("#exampleModalCenter").modal("show");
        $.ajax({
            type: 'get',
            url: "{{ url('clinical-trial-retention/participant-detail')}}" + '/' + id,
            success: function (data) {
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*  When user click add user button */
        $('#create-new-user').click(function () {
            $('#btn-save').val("create-user");
            $('#userForm').trigger("reset");
            $('#userCrudModal').html("Add New User");
            $('#ajax-crud-modal').modal('show');
            $('input[name="date"]').val('MM-DD-YYYY');
        });

        $('body').on('click', '.editProduct', function () {
            var user_id = $(this).data('id');
            $.get("{{ url('clinical-trial-manage/edit-applicant')}}" + '/' + user_id, function (data) {
                $('#model-heading').html("Edit Patient Details");
                $('#saveBtn').val("edit-user");
                $('#ajax-crud-modal').modal('show');
                $('#user_id').val(user_id);
                $('#firstname').val(data[0].firstname);
                $('#lastname').val(data[0].lastname);
                $('#email').val(data[0].email);
                $('#contact').val(data[0].contact);
                $('#patient_phy__name').val(data[0].patient_phy__name);
                $('#patient_phy__email').val(data[0].patient_phy__email);
                $('#patient_phy__phone').val(data[0].patient_phy__phone);
                $('#care_giver_name').val(data[0].care_giver_name);
                $('#care_giver_email').val(data[0].care_giver_email);
                $('#care_giver_phone').val(data[0].care_giver_phone);
            })
        });
    });

    if ($("#userForm")) {
        $("#userForm").validate({
            submitHandler: function (form) {
                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');
                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "{{ url('/') }}/clinical-trial-retention/trial-visit-create",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#userForm').trigger("reset");
                        $('#ajax-crud-modal').modal('hide');
                        location.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save Changes');
                    }
                });
            }
        })
    }
</script>

<script>
    $(document).on('click', '.submit-trial-pay', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        var clinical = $(this).data("clinical");
        $("#clinical-id").val(clinical);
        $("#visit-id").val(id);
        $("#exampleModalCenterpay").modal("show");
    });
</script>
<script>
    $(document).ready(function () {
        $(".agree-form-pay").click(function () {
            var visit = $("#visit-id").val();
            var clinicalpay = $("#clinical-id").val();
            $("#view-form-pay" + visit + clinicalpay).trigger("submit");
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#clinical-search').DataTable({
            "ajax": "{{ url('/') }}/clinical-trial-retention/trial-visit-ajax",
            "autoWidth": false,
        });
    });
</script>

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">

    $('.dater').datepicker({

        format: "mm/dd/yyyy",

        startDate: "+0d"

    });

</script> -->

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script>
  $(function() {
    $('input[name="date"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minDate: moment(),
      minYear: 2020,
      maxYear: 2040
    });
    $('input[name="date"]').val('MM-DD-YYYY');
  });
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">

    $('.timepicker').datetimepicker({

        format: 'HH:mm:ss'

    });

</script>
@endsection
