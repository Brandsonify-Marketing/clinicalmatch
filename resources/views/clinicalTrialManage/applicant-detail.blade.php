
            <div class="modal-txt">
                <h4>Patient Information</h4>
                <ul>
                  <li><strong>Participant Name:</strong><span>{{$clinicalmanages->user->firstname. " " .$clinicalmanages->user->lastname}}</span></li>
                  <li><strong>Participant Phone:</strong><span>{{$clinicalmanages->user->profile->contact}}</span></li>
                  <li><strong>Participant Email:</strong><span>{{$clinicalmanages->user->email}}</span></li>
                  <li><strong>Physician Name:</strong><span>{{$clinicalmanages->user->profile->patient_phy__name}}</span></li>
                  <li><strong>Physician Email:</strong><span>{{$clinicalmanages->user->profile->patient_phy__email}}</span></li>
                  <li><strong>Physician Phone:</strong><span>{{$clinicalmanages->user->profile->patient_phy__phone}}</span></li>
                  <li><strong>Caregiver Name:</strong><span>{{$clinicalmanages->user->profile->care_giver_name}}</span></li>
                  <li><strong>Caregiver Email:</strong><span></span>{{$clinicalmanages->user->profile->care_giver_email}}</li>
                  <li><strong>Caregiver Phone:</strong><span>{{$clinicalmanages->user->profile->care_giver_phone}}</span></li>
                </ul>
              </div>