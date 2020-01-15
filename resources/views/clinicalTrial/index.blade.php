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
                <h1>Find a Clinical Trial</h1>
              </div>
                <div class="table-details">
                        <table class="table" id="clinical-search">
                          <thead>
                            <tr class="list-item">
                              <th scope="col">Name of Clinical Trial</th>
                              <th scope="col">Posted</th>
                              <th scope="col">Expires</th>
                              <th scope="col">Research Site Name</th>
                              @if(isset(Auth::user()->role_id) && !empty(Auth::user()->role_id)) 
                                 @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                              <th></th>
                                 @endif
                              @endif   
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
@endsection
@section('scripts')
<script>
$(document).on('click','.submit-trial',function(event){
      event.preventDefault();
      var id = $(this).data("id");
      $("#exampleModalCenter").modal("show");  
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
$(document).ready(function () {
    $('#clinical-search').DataTable({
        "ajax": "{{ url('/') }}/clinical-trial/ajax"
    });
});
</script>
@endsection