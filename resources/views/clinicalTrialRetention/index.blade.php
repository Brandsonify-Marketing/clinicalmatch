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
                <h1>Trial Retention</h1>
              </div>
                <div class="table-details">
                        <table class="table" id="clinical-search">
                          <thead>
                            <tr class="list-item">
                              <th scope="col">Name of Clinical Trial</th>
                              <th scope="col">Posted</th>
                              <th scope="col">Expires</th>
                              <th scope="col">Description</th>
                              <th></th>
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
                  <p>By using Clinical Match, you agree to abide by the following</p>
                  <ul>
                    <li> All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Int</li>
                    <li>expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do no</li>
                    <li>turi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilise</li>
                    <li>every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will fr</li>
                    <li>nce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire</li>
                  </ul>
                </div>
                <div class="addinital-info">
                   <button class="btn-typo agree-form">AGREE</a>
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
        "ajax": "{{ url('/') }}/clinical-trial-retention/ajax"
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