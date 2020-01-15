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

            <h1>Patient List</h1>
            <h3>For Clinical Trial: {{$clinicaltrials->study_title}}</h3>

        </div>

        <a href="javascript:void(0)" id="create-new-user" class="btn-typo"><strong>Add Patient</strong></a>

        <div class="submit-paymnt back-btn">
            <a href="{{ route('clinicalTrialRetention.enrolled') }}">Back</a>
        </div>

        <div class="crumb-custom" style="text-align: left; margin-top: -45px;">            
            @php
            $route_id = request()->route('id');
            $trial_name = App\ClinicalTrial::where('id', $route_id)->first();
            @endphp
             <a href="{{ route('clinicalTrialManage.manage') }}">Manage Clinical Trials</a>  > 
             <a href="{{ route('clinicalTrialManage.applicant-list', $route_id) }}"> Applicant List</a>  >
             <a href="#" style="color:#000"> {{$trial_name->study_title}}</a>
        </div>
        <div class="table-details">

            <table class="table" id="clinical-search">

                <thead>

                    <tr class="list-item">

                        <th scope="col">Participant Name</th>

                        <th scope="col">Research Site</th>

                        <th scope="col">Phone Number</th>

                        <th scope="col">Email Address</th>

                        <th scope="col">Message</th>

                    </tr>
                </thead>
                <tbody id="users-crud">
                @foreach($clinicalmanages as $clinicalmanage)
                <?php
                $research_sites = App\ResearchSite::all();
                ?>
                <tr>
                <td><a href="{{ route('clinicalTrialManage.applicant-detail',$clinicalmanage->user->id) }}"  data-id="{{$clinicalmanage->user->id}}" class="submit-trial">{{$clinicalmanage->user->firstname}} {{$clinicalmanage->user->lastname}}</a></td>
                   </td>

                    <td data-label="Research Site Address ">

                        <form method="post" action="{{ route('clinicalTrialRetention.patinet-research-site',$clinicalmanage->id) }}" >

                            @csrf

                            <input type="hidden" name="clinical_manages_id" value="{{ @$clinicalmanage->id }}">

                            <select name="research_site_id" onchange="this.form.submit()" autocomplete="false">

                                @foreach($research_sites as $research_site)

                                <option <?php echo @($research_site->id == $clinicalmanage->research_site_id) ? "selected='selected'" : ""; ?> value="{{$research_site->id}}">{{@$research_site->address.", ".@$research_site->city.", ".@$research_site->state.", ".@$research_site->zipcode }}</option>

                                @endforeach

                            </select>

                        </form>

                    </td>

                    <td data-label="Phone Number"><a href="tel:{{@$clinicalmanage->user->profile->contact}}">{{@$clinicalmanage->user->profile->contact}}</a></td>

                    <td data-label="Email Address"><a href="mailto:{{ @$clinicalmanage->user->email }}">{{ @$clinicalmanage->user->email }}</a></td>

                    <td data-label="Message"><a href="{{route('message.chat',$clinicalmanage->user->id)}}">Message</a></td>

                    <td data-label="Message"><a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$clinicalmanage->user->id}}" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a></td>


                </tr>

                @endforeach

                </tr>

              </tbody>

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
                <h4 id="model-heading">Add Patient Information</h4>
                 <form id="userForm" name="userForm" class="form-horizontal">
                <div class="modal-body">
                  <input type="hidden" name="user_id" id="user_id" value="">
                  <div class="row">
                  <div class="col-md-6">            
                    <div class="form-group">
                      <label for="firstname"><strong>First Name:</strong></label>
                          <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="" maxlength="50" required="">
                      </div>
                    </div>
                    <div class="col-md-6">            
                    <div class="form-group">
                      <label for="lastname"><strong>Last Name:</strong></label>
                          <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="" maxlength="50" required="">
                    </div>
                    </div>
                    <input type="hidden" name="clinical_id" value="{{request()->route('id')}}" id="clinical_id">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="contact"><strong>Phone:</strong></label>
                          <input type="text" maxlength="10" onkeypress="return isNumberKey(this, event);" class="form-control" id="contact" name="contact" placeholder="xxx-xxx-xxxx" value="" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="email"><strong>Email:</strong></label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
                    </div>
                        <span class="invalid-feedback emailerror" style="display: none" role="alert">
                              <strong>Email Already Exist</strong>
                          </span>
                    </div>
                    
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="patient_phy__name"><strong>Physician Name:</strong></label>
                          <input type="text" class="form-control" id="patient_phy__name" name="patient_phy__name" placeholder="Physician Name" value="" required="">
                      </div>
                    </div>
                      @error('patient_phy__name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="patient_phy__email"><strong>Physician Email:</strong></label>
                          <input type="email" class="form-control" id="patient_phy__email" name="patient_phy__email" placeholder="Physician Email" value="" required="">
                      </div>
                    </div>
                    @error('patient_phy__email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  <div class="col-md-6">
                   <div class="form-group">     
                   <label for="patient_phy__phone"><strong>Physician Phone:</strong></label>
                          <input type="text" maxlength="10" class="form-control" id="patient_phy__phone" name="patient_phy__phone" onkeypress="return isNumberKey(this, event);" placeholder="xxx-xxx-xxxx" value="" required="">
                      </div>
                    </div>
                    @error('patient_phy__phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror 
                  <div class="col-md-6">  
                   <div class="form-group">
                    <label for="care_giver_name"><strong>Caregiver Name:</strong></label>
                          <input type="text" class="form-control" id="care_giver_name" name="care_giver_name" placeholder="Caregiver Name" value="" required="">
                      </div>
                    </div>
                      @error('care_giver_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="care_giver_email"><strong>Caregiver Email:</strong></label>
                          <input type="email" class="form-control" id="care_giver_email" name="care_giver_email" placeholder="Caregiver Email" value="" required="">
                      </div>
                    </div>
                      @error('care_giver_email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                   <div class="col-md-6">
                   <div class="form-group">
                    <label for="care_giver_phone"><strong>Caregiver Phone:</strong></label>
                          <input type="text" maxlength="10" class="form-control" id="care_giver_phone" name="care_giver_phone" onkeypress="return isNumberKey(this, event);" placeholder="xxx-xxx-xxxx" value="" required="">
                      </div>
                    </div>
                      @error('care_giver_phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror 
                </div>                     
                </div>
                <div class="addinital-info">
                    <button type="submit" id="btn-save" class="btn-typo agree-form" value="create">
                      Save Patient Details
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function isNumberKey(txt, evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
    if (txt.value.indexOf('.') === - 1) {
    return true;
    } else {
    return false;
    }
    } else {
    if (charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;
    }
    return true;
    }
</script>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->

<script>
$(document).on('click','.submit-trial',function(event){
      event.preventDefault();
      var id = $(this).data("id");
      $("#exampleModalCenter").modal("show");  
      $.ajax({
      type: 'get',
      url: "{{ url('clinical-trial-manage/applicant-detail')}}"+'/'+id,
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
$(document).ready(function(){
    $(".agree-form").click(function(){
      var clinical = $("#clinical-id").val();
    });
});
</script>
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
    });
 
  $('body').on('click', '.editProduct', function () {
      var user_id = $(this).data('id');
      $.get("{{ url('clinical-trial-manage/edit-applicant')}}"+'/'+user_id, function (data) {
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
   /* When click edit user */
   // delete user login
   //  $('body').on('click', '.delete-user', function () {
   //      var user_id = $(this).data("id");
   //      confirm("Are You sure want to delete !");
 
   //      $.ajax({
   //          type: "DELETE",
   //          url: "{{ url('ajax-crud')}}"+'/'+user_id,
   //          success: function (data) {
   //              $("#user_id_" + user_id).remove();
   //          },
   //          error: function (data) {
   //              console.log('Error:', data);
   //          }
   //      });
   //  });   
  });
 
 if ($("#userForm").length > 0) {
      $("#userForm").validate({
     submitHandler: function(form) {
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');  
      $.ajax({
          data: $('#userForm').serialize(),
          url: "{{ url('/') }}/clinical-trial-manage/store-applicant",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              console.log(data['error']);
              if(data['error']){
                 $(".emailerror").show();
                 $('#btn-save').html('Save Patient Details');  
              }else{
              var user = '<tr id="user_id_' + data['user'].id + '"><td><a href="{{ url('/') }}/clinical-trial-manage/applicant-detail/'+data['user'].id+'" class="submit-trial" data-id="'+data['user'].id+'">' + data['user'].firstname + data['user'].lastname + '</a></td>';
              user +='<td></td>'; 
              user +='<td><a href="tel:'+data['profile'].contact+'">'+data['profile'].contact+'</a></td>' ;
              user +='<td><a href="mailto:'+data['user'].email+'">'+data['user'].email+'</a></td>' ;
              user +='<td><a href="{{ url('/') }}/message/chat/'+data['user'].id+'">Message</a></td>' ;
              if (actionType == "create-user") {
                  $('#users-crud').append(user);
              } else {
                  $("#user_id_" + data['user'].id).replaceWith(user);
              }
              $('#userForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes'); 
              location.reload();       }  
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
<script type="text/javascript">
@if (count($errors) > 0)
    $('#ajax-crud-modal').modal('show');
@endif
</script>
@endsection