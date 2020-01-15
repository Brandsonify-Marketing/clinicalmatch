<div class="modal-txt">
                <h4>Trial Information</h4>
                <ul>
                  <li><strong>Full Title of Study: </strong><span>{{@$clinicaltrials->study_title}}</span></li>
                  <li><strong>Principal Investigator’s Name: </strong><span>{{@$clinicaltrials->private_name}}</span></li>
                  <li><strong>Research Site Name: </strong><span>{{@$clinicaltrials->site_name}}</span></li>
                  <li><strong>Phone: </strong><span> {{ preg_replace('#(\d{3})(\d{3})(\d{4})#', '$1-$2-$3', @$clinicaltrials->phone_no) }}</span></li>
                  <li><strong>Address: </strong><span>{{@$clinicaltrials->address. ", " . @$clinicaltrials->city. ", " . @$clinicaltrials->state. ", " . @$clinicaltrials->zipcode}}
                  </span></li>        
                  @if(!empty($clinicaltrials->medical_condition))       
                  <li><strong>Medical Condition: </strong><span>{{ @$clinicaltrials->medical_condition }}</span></li>
                  @endif
                  <li><strong>Rationale for study: </strong><span>{{ @$clinicaltrials->rationale }}</span></li>
                  <li><strong>Irb Form: </strong><span><a href="{{asset('storage/irb_forms/'.@$clinicaltrials->form_irb)}}" target="_blank">
                           <img src="{{ asset('images/informed.png')}}">  
                           </a></span></li> 
                </ul>
  </div>