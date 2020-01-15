@extends('layouts.dashboard-menu')

@section('content')
<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h5>My Account</h5>
            <h1>Transaction History</h1>
        </div>
        @php
            $url_name = url()->current();
            $url = url('/account/transaction-history/all');
            $paid = url('/account/transaction-history/1');
            $unpaid = url('account/transaction-history/2');
        @endphp
        @if(\Session::has('success'))

        <div class="alert alert-success">
            {{\Session::get('success')}}
        </div>

        @endif
        <div class="clinically-form">
         <div class="table-tab">
          <ul>
              <li class=<?php if ($url_name == $url) echo "active"; ?>>
                <a href="{{ route('account.transaction-history','all')}}">
                <label>All</label>
              </a>
            </li>
            <li >
             <li class=<?php if ($url_name == $paid) echo "active"; ?>>
              <a href="{{ route('account.transaction-history','1')}}">
              <label>Paid</label>
              </a>
            </li>
            <li class=<?php if ($url_name == $unpaid) echo "active"; ?>>
              <a href="{{ route('account.transaction-history','2')}}">
              <label>Unpaid</label>
              </a>
            </li>
          </ul>
        </div>
            <div class="table-details application-detail">
            <table id="personalinfo" class="table tble-bordered" style="width:100%">
                <a href="{{route('account.transactions-pdf')}}" class="btn-typo">Export PDF</a>
                    <tr>
                        <th>Participant Name</th>
                        <th>Service Type</th>
                        <th>Service Date</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>PDF</th>
                        <th>PDF Download</th>
                    </tr>  
                    @foreach ($invoices as $invoice)   
                        <tr>
                            <td><a href="{{ route('account.transaction-detail',$invoice->id) }}"  data-id="{{ $invoice->id }}" class="submit-trial">{{$invoice->metadata->patient_name}}</a></td>
                            <td>{{ $invoice->metadata->service_type }}</td>
                            <td>{{ $invoice->metadata->service_date }}</td>
                            <td>{{ $invoice->metadata->cost }}</td>
                            <td>{{ $invoice->status }}</td>
                            <td><a href="{{ $invoice->hosted_invoice_url }}" target="_blank">PDF</a></td>
                            <td><a href="{{ route('invoicedetail', $invoice->id) }}">Download</a></td>
                        </tr>
                    @endforeach   
            </table>
        </div>
        </div>
    </div>
</div>

<div class="modal syposis-modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <input type="hidden" name="user_id" id="user_id" value="">
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
      url: "{{ url('account/transaction-detail')}}"+'/'+id,
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

