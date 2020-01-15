<div class="modal-txt">
        <h4 id="model-heading">Scheduled Visits</h4>
                <ul>
                  <table id="personalinfo" class="table tble-bordered" style="width:100%">
                    <tr>
                        <th>Patient Name</th>
                        <th>Clinical Trial Name</th>
                        <th>Trial Visit Date</th>
                        <th>Trial Visit Time</th>
                    </tr>  
                    @foreach ($trialvisits as $trialvisit)   
                        <tr>
                            <td>{{@$trialvisit->user->firstname. " " .@$trialvisit->user->lastname}}</td>
                            <td>{{@$trialvisit->clinicaltrial->study_title}}</td>
                            <td>{{@$trialvisit->date}}</td>
                            <td>{{@$trialvisit->time }}</td>
                        </tr>
                    @endforeach   
                </table>
                </ul>
  </div>