<div class="modal-txt">
        <h4 id="model-heading">Pending Visits</h4>
                <ul>
                  <table id="personalinfo" class="table tble-bordered" style="width:100%">
                    <tr>
                        <th>Patient Name</th>
                        <th>Clinical Trial Name</th>
                        <th>Visit Name</th>
                        <th>Trial Visit Date</th>
                        <th>Trial Visit Time</th>
                    </tr>  
                    @foreach ($trialvisits as $trialvisit)   
                        <tr>
                            <td>{{@$trialvisit->patient->firstname. " " .@$trialvisit->patient->lastname}}</td>
                            <td>{{@$trialvisit->clinicaltrial->study_title}}</a></td>
                            <td>{{@$trialvisit->visit_name}}</a></td>
                            <td>{{@$trialvisit->date}}</a></td>
                            <td>{{@$trialvisit->time }}</td>
                        </tr>
                    @endforeach   
                </table>
                </ul>
  </div>