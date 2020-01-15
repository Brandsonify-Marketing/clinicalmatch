<div class="modal-txt">
          <h4>Subinvestigator Information</h4>
          <ul>
            <li><strong>Participant Name: </strong><span>{{@$subinvestigators->user->firstname . " " . @$subinvestigators->user->lastname}}</span></li>
            <li><strong>Participant Phone: </strong><span><a href="tel:{{@$subinvestigators->user->profile->contact}}">{{@$subinvestigators->user->profile->contact}}</a></span></li>
            <li><strong>Participant Email: </strong><span><a href="mailto:{{ @$subinvestigators->user->email}}">{{ @$subinvestigators->user->email }}</a></span></li>
            <li><span><a href="{{route('message.chat',$subinvestigators->user->id)}}">Send Message</a></span></li>
          </ul>
</div>