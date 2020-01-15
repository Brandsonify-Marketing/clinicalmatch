<div class="modal-txt">
          <h4>Transaction Information</h4> 
          <ul>
          	<li><strong>ID: </strong><span>{{ @$invoices->lines->data[0]->id }}</span></li>
          	<li><strong>Description: </strong><span>{{ @$invoices->lines->data[0]->description }}</span></li>
          	<li><strong>Patient Name: </strong><span>{{ @$invoices->metadata->patient_name }}</span></li>
          	<li><strong>Service Type: </strong><span>{{ @$invoices->metadata->service_type }}</span></li>
          	<li><strong>Service Date: </strong><span>{{ @$invoices->metadata->service_date }}</span></li>
          	<li><strong>Cost: </strong><span>{{ @$invoices->metadata->cost }}</span></li>
            <li><strong>Email: </strong><span>{{ @$invoices->customer_email}}</span></li>
            <li><strong>Date: </strong><span>{{ @$invoices->date()->toFormattedDateString() }}</span></li>
            <li><strong>Total: </strong><span>{{@$invoices->total()}}</span></li>
            <li><strong>Billing: </strong><span>{{ @$invoices->billing }}</span></li>     
	        <li><strong>Amount Paid: </strong><span>{{ @$invoices->amount_paid }}</span></li>     
	        <li><strong>Amount Due: </strong><span>{{ @$invoices->amount_due }}</span></li>      
	        <li><strong>Amount Remaining: </strong><span>{{ @$invoices->amount_remaining }}</span></li>     
	        <li><strong>Status: </strong><span>{{ @$invoices->status }}</span></li>     
          </ul>
</div>