<div class="modal-txt">
          <h4>Participant Information</h4>
          <ul>
            <li><strong>Participant Name: </strong><span>{{@$clinicalmanages->user->firstname . " " . @$clinicalmanages->user->lastname}}</span></li>
            <li><strong>Participant Phone: </strong><span><a href="tel:{{@$clinicalmanages->user->profile->contact}}">{{@$clinicalmanages->user->profile->contact}}</a></span></li>
            @if(isset($clinicalmanages->user->profile->address) && !empty($clinicalmanages->user->profile->address))
            <li><strong>Participant Address: </strong><span>{{@$clinicalmanages->user->profile->address}}</span></li>
            @endif
            <li><strong>Participant Email: </strong><span><a href="mailto:{{ @$clinicalmanages->user->email}}">{{ @$clinicalmanages->user->email }}</a></span></li>
            <li><span><a href="{{route('message.chat',$clinicalmanages->user->id)}}">Send Message</a></span></li>
          </ul>
</div>