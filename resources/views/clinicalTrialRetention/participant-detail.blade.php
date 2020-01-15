<div class="modal-txt">
          <h4>Participant Information</h4>
          <ul>
            <li><strong>Participant Name: </strong><span>{{@$trialvisits->patient->firstname . " " . @$trialvisits->patient->lastname}}</span></li>
            <li><strong>Participant Phone: </strong><span><a href="tel:{{@$trialvisits->patient->profile->contact}}">{{@$trialvisits->patient->profile->contact}}</a></span></li>
            <li><strong>Participant Email: </strong><span><a href="mailto:{{ @$trialvisits->patient->email}}">{{ @$trialvisits->patient->email }}</a></span></li>
            <li><span><a href="{{route('message.chat',$trialvisits->patient->id)}}">Send Message</a></span></li>
          </ul>
</div>