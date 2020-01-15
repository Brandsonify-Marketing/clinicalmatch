<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <div class="modal-logo text-center" style="text-align: center;">
                  <a href="#">
                 <img src="{{ asset('images/logo.png')}}">
            </a>
<!--             <h5>My Account</h5> -->
            <h1 style="text-align: center;">Transaction History</h1>
        </div>
            <div class="table-details application-detail">
            <table id="personalinfo" class="table tble-bordered" style="width:100%">
                    <tr>
                        <th>Patient Name</th>
                        <th>Service Type</th>
                        <th>Service Date</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Email</th>
                    </tr>  
                    @foreach ($invoices as $invoice)   
                        <tr>
                            <td>{{@$invoice->metadata->patient_name}}</a></td>
                            <td>{{@$invoice->metadata->service_type }}</td>
                            <td>{{@$invoice->metadata->service_date }}</td>
                            <td>{{@$invoice->metadata->cost }}</td>
                            <td>{{@$invoice->status }}</td>
                            <td>{{@$invoice->customer_email}}</td>
                        </tr>
                    @endforeach   
            </table>
        </div>
        </div>
    </div>
</div>

