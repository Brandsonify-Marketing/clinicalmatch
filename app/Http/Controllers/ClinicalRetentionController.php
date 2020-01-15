<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClinicalTrial;
use App\RetentionLocation;
use App\ResearchSite;
use App\TrialVisit;
use App\TrialVisitNumber;
use App\RetentionPatient;
use App\ClinicalManage;
Use Carbon\Carbon;
use Redirect,
    Response;
use Illuminate\Support\Facades\Auth;

class ClinicalRetentionController extends Controller {

    /**
     * Display a list of retained Trials.
     *
     * @return \Illuminate\Http\Response
     */
    public function enrolled() {
        return view('clinicalTrialRetention.enrolled', ['clinicaltrials' => ClinicalTrial::all()]);
    }

    /**
     * Display a list of retained Trials.
     *
     * @return \Illuminate\Http\Response
     */
    public function enrolledAjax() {
        if (Auth::user()->role_id == 8) {
            $clinicaltrials = ClinicalTrial::where('status', 1)->where('enroll_status', 1)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($clinicaltrials as $k => $clinicaltrial) {
                $site_Count = ResearchSite::where(['clinical_id' => $clinicaltrial->id,])->count();
                $clinicalmanage = ClinicalManage::where('clinical_id', $clinicaltrial->id)
                        ->where('status', '=', 1)
                        ->count();
                $trial_visit_count = TrialVisitNumber::where(['clinical_id' => $clinicaltrial->id,])->count();
                $data[$k][] = '<a  data-id="' . $clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $clinicaltrial->id) . '" class="submit-trial">' . @$clinicaltrial->study_title . '</a>';
                if ($site_Count == 0) {
                    $site_Count = "Add";
                }
                $data[$k][] = '<a href="' . route("clinicalTrialRetention.research-site", $clinicaltrial->id) . '">' . @$site_Count . '</a>';
                if (@$trial_visit_count)
                    $data[$k][] = '<a href="' . route("clinicalTrialRetention.trial-visit-number", $clinicaltrial->id) . '">' . @$trial_visit_count . '</a>';
                else
                    $data[$k][] = '<a href="' . route("clinicalTrialRetention.trial-visit-number", $clinicaltrial->id) . '">Add</a>';
                if ($clinicalmanage == 0) {
                    $clinicalmanage = "Add";
                }
                $data[$k][] = '<a href="' . route("clinicalTrialManage.applicant-list", $clinicaltrial->id) . '">' . @$clinicalmanage . '</a>';
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
        if (Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7) {
            $clinicaltrials = ClinicalTrial::where('status', 1)->where('user_id', Auth::user()->id)->where('enroll_status', 1)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($clinicaltrials as $k => $clinicaltrial) {
                $site_Count = ResearchSite::where(['clinical_id' => $clinicaltrial->id,])->count();
                $clinicalmanage = ClinicalManage::where('clinical_id', $clinicaltrial->id)
                        ->where('status', '=', 1)
                        ->count();
                $trial_visit_count = TrialVisitNumber::where(['clinical_id' => $clinicaltrial->id,])->count();
                $data[$k][] = '<a  data-id="' . $clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $clinicaltrial->id) . '" class="submit-trial">' . @$clinicaltrial->study_title . '</a>';
                if ($site_Count == 0) {
                    $site_Count = "Add";
                }
                $data[$k][] = '<a href="' . route("clinicalTrialRetention.research-site", $clinicaltrial->id) . '">' . @$site_Count . '</a>';
                if (@$trial_visit_count)
                    $data[$k][] = '<a href="' . route("clinicalTrialRetention.trial-visit-number", $clinicaltrial->id) . '">' . @$trial_visit_count . '</a>';
                else
                    $data[$k][] = '<a href="' . route("clinicalTrialRetention.trial-visit-number", $clinicaltrial->id) . '">Add</a>';
                if ($clinicalmanage == 0) {
                    $clinicalmanage = "Add";
                }
                $data[$k][] = '<a href="' . route("clinicalTrialManage.applicant-list", $clinicaltrial->id) . '">' . @$clinicalmanage . '</a>';
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
    }

    public function trailDetail($id) {
        return view('clinicalTrialRetention.trial-detail', ['clinicaltrials' => ClinicalTrial::find($id), 'clinicalmanage' => ClinicalManage::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first()])->render();
    }

    /**
     * Create list of Location and Patients
     *
     * @return \Illuminate\Http\Response
     */
    public function researchSite($id) {
        $retentionslocations = ResearchSite::where([
                    'clinical_id' => $id,
//            'user_id' => auth()->user()->id,
                ])->get();
//        $retentionspatients = RetentionPatient::where(['clinical_id' => $id,'user_id' => auth()->user()->id,])->get();
//        if(is_null($retentionslocations))
//        {
//            return view('clinicalTrialRetention.create', ['clinicaltrials' => ClinicalTrial::find($id),
//                  'retentionspatients' => RetentionPatient::where(['clinical_id' => $id,'user_id' => auth()->user()->id,])->get()]);
//        }
//        elseif(is_null($retentionspatients))
//        {
//               return view('clinicalTrialRetention.create', ['clinicaltrials' => ClinicalTrial::find($id),
//                  'retentionslocations' => RetentionLocation::where(['clinical_id' => $id,'user_id' => auth()->user()->id,])->get()]);
//        }
//        elseif(is_null($retentionspatients) && is_null($retentionslocations))
//        {
//             return view('clinicalTrialRetention.create', ['clinicaltrials' => ClinicalTrial::find($id)]);
//        }
//        else
//        {
        return view('clinicalTrialRetention.research-site.index', [
            'clinicaltrials' => ClinicalTrial::find($id),
//                  'retentionspatients' => RetentionPatient::where(['clinical_id' => $id,'user_id' => auth()->user()->id,])->get(),
            'retentionslocations' => $retentionslocations]);
//        }
    }

    public function trialVisitCreate() {
        return view('clinicalTrialRetention.trial-visit-create', [
            'clinicaltrials' => ClinicalTrial::all(),
            'researchSites' => ResearchSite::all()
        ]);
    }

    /**
     * Displays the personal information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function researchSiteInfo($id) {
        return view('clinicalTrialRetention.research-site.info', ['researchSite' => ResearchSite::where('id', $id)->first()]);
    }

    /**
     * Store list of Location and Patients
     *
     * @return \Illuminate\Http\Response
     */
    public function storeResearchSite(Request $request, $id) {
        $this->validate($request, [
            'contact_email' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
        ]);
        $retentionlocations = new ResearchSite([
            'user_id' => auth()->user()->id,
            'clinical_id' => $id,
            'contact_email' => $request->contact_email,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'site_number' => ResearchSite::where([
                'clinical_id' => $id,
            ])->count() + 1,
        ]);
        $retentionlocations->save();
        return view('clinicalTrialRetention.research-site.index', [
            'clinicaltrials' => ClinicalTrial::find($id),
            'retentionslocations' => ResearchSite::where(['clinical_id' => $id,
            ])->get()]);
    }

    public function editResearchSite($id) {
        $researchSite = ResearchSite::where('id', $id)
                ->first();
        return view('clinicalTrialRetention.research-site.edit', compact('researchSite', 'id'));
    }

    public function updateResearchSite(Request $request, $id) {
        $this->validate($request, [
            'contact_email' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
        ]);
        $retentionlocations = ResearchSite::find($id);
        $retentionlocations->contact_email = $request->get('contact_email');
        $retentionlocations->contact_name = $request->get('contact_name');
        $retentionlocations->contact_phone = $request->get('contact_phone');
        $retentionlocations->address = $request->get('address');
        $retentionlocations->city = $request->get('city');
        $retentionlocations->state = $request->get('state');
        $retentionlocations->zipcode = $request->get('zipcode');
        $retentionlocations->save();
        return redirect()->route('clinicalTrialRetention.research-site', $retentionlocations->clinical_id)->with('success', 'Research Site updated!');
    }

    /**
     * Delete the Banking information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSite($id) {
        $researchsite = ResearchSite::findorFail($id);
        $researchsite->delete();
        return redirect()->back();
    }

    /**
     * Store list of Location and Patients
     *
     * @return \Illuminate\Http\Response
     */
    // public function trialVisitStore(Request $request) {
    //     $this->validate($request, [
    //         'patient_id' => 'required',
    //         'clinical_id' => 'required',
    //         'research_site_id' => 'required',
    //         'date' => 'required',
    //         'time' => 'required',
    //         'status' => 'required',
    //         'case_note' => 'required',
    //     ]);
    //     $retentionlocations = new TrialVisit([
    //         'user_id' => auth()->user()->id,
    //         'patient_id' => $request->patient_id,
    //         'clinical_id' => $request->clinical_id,
    //         'research_site_id' => $request->research_site_id,
    //         'date' => $request->date,
    //         'time' => $request->time,
    //         'status' => $request->status,
    //         'case_note' => $request->case_note,
    //     ]);
    //     $retentionlocations->save();
    //     return view('clinicalTrialRetention.trial-visit-create', [
    //         'clinicaltrials' => ClinicalTrial::all(),
    //         'researchSites' => ClinicalTrial::all()
    //     ]);
    // }
    /**
     * Update the patient research site id
     *
     * @return \Illuminate\Http\Response
     */
    public function patinetResearchSite(Request $request, $id) {
        $researchSite = ClinicalManage::find($id);
        $researchSite->research_site_id = $request->research_site_id;
        $researchSite->save();
        return redirect()->back();
    }

    public function trialVisit() {
        $trialvisits = TrialVisit::orderBy('id', 'ASC')->orderBy('id', 'ASC')->get();
        return view('clinicalTrialRetention.trial-visit', ['trialvisits' => $trialvisits])->render();
    }

    public function trialVisitStore(Request $request) {
        $trialId = $request->user_id;
        $retentionlocations = TrialVisit::updateOrCreate(['id' => $trialId], ['user_id' => auth()->user()->id,
                    'patient_id' => $request->patient_id,
                    'clinical_id' => $request->clinical_id,
                    'research_site_id' => $request->research_site_id,
                    'visit_name' => $request->visit_name,
                    'date' => $request->date,
                    'time' => $request->time,
                    'status' => $request->status,
                    'case_note' => $request->case_note]);
        return Response::json(array(
                    'retentionlocations' => $retentionlocations,
        ));
    }

    public function patientVisit() {
        $trialVisits = TrialVisit::orderBy('id', 'ASC')->get();
        return view('clinicalTrialRetention.patient-visit', ['trialVisits' => $trialVisits])->render();
    }

    public function patientVisitAjax() {
        if (Auth::user()->role_id == 8) {
            $trialVisits = TrialVisit::orderby('id', 'DESC')->get();
//            print_r($trialVisits);
            $data = [];
            foreach ($trialVisits as $k => $trialVisit) {
//                dd($trialVisit->patient);
                $trial_visit_count = TrialVisitNumber::where(['clinical_id' => $trialVisit->clinical_id])->count();
                $data[@$trialVisit->patient->id . @$trialVisit->clinical_id][] = '<a data-id="' . @$trialVisit->id . '" href="' . route("clinicalTrialRetention.participant-info", @$trialVisit->id) . '" class="submit-trial">' . @$trialVisit->patient->firstname . " " . @$trialVisit->patient->lastname . '</a>';
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = '<a  data-id="' . $trialVisit->clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $trialVisit->clinicaltrial->id) . '" class="submit-trial-visit">' . @$trialVisit->clinicaltrial->study_title . '</a>';
                $complete_count = TrialVisit::where('user_id', $trialVisit->user->id)
                        ->where('patient_id', $trialVisit->patient->id)
                        ->where('status', '=', 2)
                        ->count();
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = '<a data-id="' . $trialVisit->id . '" href="' . route("clinicalTrialRetention.complete-visit-details", ['id' => $trialVisit->clinicaltrial->id, 'patient_id' => $trialVisit->patient->id]) . '" class="submit-trial-complete">' . @$complete_count . '</a>';
                $scheduled_count = TrialVisit::where('user_id', $trialVisit->user->id)
                        ->where('patient_id', $trialVisit->patient->id)
                        ->where('status', '=', 1)
                        ->count();
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = '<a data-id="' . $trialVisit->id . '" href="' . route("clinicalTrialRetention.scheduled-visit-details", ['id' => $trialVisit->clinicaltrial->id, 'patient_id' => $trialVisit->patient->id]) . '" class="submit-trial-scheduled">' . @$scheduled_count . '</a>';
                $trial_visit_details = ClinicalTrial::where(['id' => $trialVisit->clinical_id])->first();
                $trial_visit_total = @$trial_visit_details->no_of_visits;
                $pending_count = @$trial_visit_count - @$complete_count - @$scheduled_count;
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = @$trial_visit_total - @$complete_count - @$scheduled_count;
                if (@$trial_visit_total)
                    $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = @$trial_visit_total;
                else
                    $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = 0;
            }
            $data_complete = [];
            foreach ($data as $k => $val) {
                $data_complete[] = $val;
            }
            $dataArray['data'] = $data_complete;

            print_r(json_encode($dataArray));
        }
        if (Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7) {
            $trialVisits = TrialVisit::where('user_id', Auth::user()->id)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($trialVisits as $k => $trialVisit) {
                $trial_visit_count = TrialVisitNumber::where(['clinical_id' => $trialVisit->clinical_id])->count();
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = '<a data-id="' . $trialVisit->id . '" href="' . route("clinicalTrialRetention.participant-info", $trialVisit->id) . '" class="submit-trial">' . @$trialVisit->patient->firstname . " " . @$trialVisit->patient->lastname . '</a>';
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = '<a  data-id="' . $trialVisit->clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $trialVisit->clinicaltrial->id) . '" class="submit-trial-visit">' . @$trialVisit->clinicaltrial->study_title . '</a>';
                $complete_count = TrialVisit::where('user_id', $trialVisit->user->id)
                        ->where('patient_id', $trialVisit->patient->id)
                        ->where('status', '=', 2)
                        ->count();
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = '<a data-id="' . $trialVisit->id . '" href="' . route("clinicalTrialRetention.complete-visit-details", ['id' => $trialVisit->clinicaltrial->id, 'patient_id' => $trialVisit->patient->id]) . '" class="submit-trial-complete">' . @$complete_count . '</a>';
                $scheduled_count = TrialVisit::where('user_id', $trialVisit->user->id)
                        ->where('patient_id', $trialVisit->patient->id)
                        ->where('status', '=', 1)
                        ->count();
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = '<a data-id="' . $trialVisit->id . '" href="' . route("clinicalTrialRetention.scheduled-visit-details", ['id' => $trialVisit->clinicaltrial->id, 'patient_id' => $trialVisit->patient->id]) . '" class="submit-trial-scheduled">' . @$scheduled_count . '</a>';
                $trial_visit_details = ClinicalTrial::where(['id' => $trialVisit->clinical_id])->first();
                $trial_visit_total = @$trial_visit_details->no_of_visits;
                $pending_count = @$trial_visit_count - @$complete_count - @$scheduled_count;
                $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = @$trial_visit_total - @$complete_count - @$scheduled_count;
                if (@$trial_visit_total)
                    $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = @$trial_visit_total;
                else
                    $data[$trialVisit->patient->id . $trialVisit->clinical_id][] = 0;
            }
            $data_complete = [];
            foreach ($data as $k => $val) {
                $data_complete[] = $val;
            }
            $dataArray['data'] = $data_complete;
            print_r(json_encode($dataArray));
        }
    }

    public function completeVisits($id) {
        $trialvisits = TrialVisit::where([
                    'id' => $id,
                ])->first();
        $trials = TrialVisit::where([
                    'clinical_id' => $trialvisits->clinical_id,
                    'patient_id' => $trialvisits->patient_id,
                    'status' => 2
                ])->get();
        return view('clinicalTrialRetention.complete-visits', ['trialvisits' => $trials])->render();
    }

    public function scheduledVisits($id) {

        $trialvisits = TrialVisit::where([
                    'id' => $id,
                ])->first();
        $trials = TrialVisit::where([
                    'clinical_id' => $trialvisits->clinical_id,
                    'patient_id' => $trialvisits->patient_id,
                    'status' => 1
                ])->get();
        return view('clinicalTrialRetention.scheduled-visits', ['trialvisits' => $trials])->render();
    }

    /**
     * Create list of Location and Patients
     *
     * @return \Illuminate\Http\Response
     */
    public function trialVisitNumber($id) {
        $vists = TrialVisitNumber::where([
                    'clinical_id' => $id,
                ])->get();
        $research_sites = ResearchSite::where('clinical_id', $id)->get();
        return view('clinicalTrialRetention.trial-visit-number', [
            'clinicaltrials' => ClinicalTrial::find($id),
            'research_sites' => $research_sites,
            'vists' => $vists]);
    }

    /**
     * Store list of trial Visit Number
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTrialVisitNumber(Request $request, $id) {
        $this->validate($request, [
            'research_site_id' => 'required',
            'frequency' => 'required',
            'visitor_number' => 'required',
        ]);
        $trialVisitNumber = new TrialVisitNumber([
            'user_id' => auth()->user()->id,
            'clinical_id' => $id,
            'research_site_id' => $request->research_site_id,
            'frequency' => $request->frequency,
            'visitor_number' => $request->visitor_number,
        ]);
        $trialVisitNumber->save();
        $research_sites = ResearchSite::where('clinical_id', $id)->get();
        return view('clinicalTrialRetention.trial-visit-number', [
            'clinicaltrials' => ClinicalTrial::find($id),
            'research_sites' => $research_sites,
            'vists' => TrialVisitNumber::where(['clinical_id' => $id,
            ])->get()]);
    }

    /**
     * Display a list of retained Trials.
     *
     * @return \Illuminate\Http\Response
     */
    public function trialVisitAjax() {
        if (Auth::user()->role_id == 8) {
            $trialVisits = TrialVisit::orderby('id', 'DESC')->get();
            $data = [];
            foreach ($trialVisits as $k => $trialVisit) {
                $clinical_id = @$trialVisit->clinical_id;
                $clinicaltrialstripe = ClinicalTrial::find($clinical_id);
                $data[$k][] = '<a  data-id="' . $trialVisit->id . '" href="' . route("clinicalTrialRetention.participant-info", $trialVisit->id) . '" class="submit-trial">' . @$trialVisit->patient->firstname . " " . @$trialVisit->patient->lastname . '</a>';
                $data[$k][] = '<a  data-id="' . $trialVisit->clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $trialVisit->clinicaltrial->id) . '" class="submit-trial-visit">' . @$trialVisit->clinicaltrial->study_title . '</a>';
                $data[$k][] = @$trialVisit->researchSite->address . ", " . @$trialVisit->researchSite->city . ", " . @$trialVisit->researchSite->city . ", " . @$trialVisit->researchSite->zipcode;
                $data[$k][] = Carbon::parse(@$trialVisit->date)->format("m/d/Y") . " " . @$trialVisit->time;
                if ($trialVisit->status == 1) {
                    $trialVisit->status = "Upcoming";
                } elseif ($trialVisit->status == 2) {
                    $trialVisit->status = "Completed";
                } elseif ($trialVisit->status == 3) {
                    $trialVisit->status = "Canceled";
                } else {
                    $trialVisit->status = "";
                }
                $data[$k][] = @$trialVisit->status;
                $data[$k][] = @$trialVisit->case_note;
                if ($trialVisit->charge_status == '1' && $trialVisit->status == 'Completed') {
                    $charging_status = "Paid";
                    $data[$k][] = @$charging_status;
                } elseif ($trialVisit->status == 'Completed' && (isset($clinicaltrialstripe->user->stripe_id) && !empty($clinicaltrialstripe->user->stripe_id))) {
                    $data[$k][] = '<form action="' . route("charge-visit", [$trialVisit->id, $trialVisit->clinical_id]) . '" method="get" 
                                    id="view-form-pay' . $trialVisit->id . $trialVisit->clinical_id . '">
                                   <a href="#" class="submit-trial-pay" data-id="' . $trialVisit->id . '" 
                                   data-clinical="' . $trialVisit->clinical_id . '" id="submitBtnPay">Pay Now</a>
                                   <input type="submit" value="COMPLETE" id="submitBtnPay" class="btn-typo" style="display:none;">
                                   </form>';
                } elseif ($trialVisit->status == 'Completed' && empty($clinicaltrialstripe->user->stripe_id)) {
                    // dd($clinicaltrialstripe->user);
                    $data[$k][] = '<a href="' . route("account.payment.add-principal", @$clinicaltrialstripe->user->id) . '" data-id="' . @$clinicaltrialstripe->user->id . '" >Add CC Info for this PI</a>';
                } else {
                    $data[$k][] = '';
                }
                if ($trialVisit->charge_status == '1' && $trialVisit->status == 'Completed') {
                    $edit_status = "";
                    $data[$k][] = @$edit_status;
                } else {
                    $data[$k][] = '<a href="' . route("clinicalTrialRetention.edit-trial-visit", @$trialVisit->id) . '">Edit</a>';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
        if (Auth::user()->role_id == 7 || Auth::user()->role_id == 6 || Auth::user()->role_id == 5) {
            $trialVisits = TrialVisit::where('user_id', Auth::user()->id)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($trialVisits as $k => $trialVisit) {
                $clinical_id = $trialVisit->clinical_id;
                $clinicaltrialstripe = ClinicalTrial::find($clinical_id);
                $data[$k][] = '<a  data-id="' . $trialVisit->id . '" href="' . route("clinicalTrialRetention.participant-info", $trialVisit->id) . '" class="submit-trial">' . @$trialVisit->patient->firstname . " " . @$trialVisit->patient->lastname . '</a>';
                $data[$k][] = '<a  data-id="' . $trialVisit->clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $trialVisit->clinicaltrial->id) . '" class="submit-trial-visit">' . @$trialVisit->clinicaltrial->study_title . '</a>';
                $data[$k][] = @$trialVisit->researchSite->address . ", " . @$trialVisit->researchSite->city . ", " . @$trialVisit->researchSite->city . ", " . @$trialVisit->researchSite->zipcode;
                $data[$k][] = Carbon::parse(@$trialVisit->date)->format("m/d/Y") . " " . @$trialVisit->time;
                if ($trialVisit->status == 1) {
                    $trialVisit->status = "Upcoming";
                } elseif ($trialVisit->status == 2) {
                    $trialVisit->status = "Completed";
                } elseif ($trialVisit->status == 3) {
                    $trialVisit->status = "Canceled";
                } else {
                    $trialVisit->status = "";
                }
                $data[$k][] = @$trialVisit->status;
                $data[$k][] = @$trialVisit->case_note;
                if ($trialVisit->charge_status == '1' && $trialVisit->status == 'Completed') {
                    $charging_status = "Paid";
                    $data[$k][] = @$charging_status;
                } elseif ($trialVisit->status == 'Completed' && (isset(Auth::user()->stripe_id) && !empty(Auth::user()->stripe_id))) {
                    $data[$k][] = '<form action="' . route("charge", $trialVisit->id) . '" method="get" id="view-form-pay' . $trialVisit->id . '">
                                       <a href="#" class="submit-trial-pay" data-id="' . $trialVisit->id . '" id="submitBtnPay">Pay Now</a>
                                       <input type="submit" value="COMPLETE" id="submitBtnPay" class="btn-typo" style="display:none;">
                                       </form>';
                } elseif (@$trialVisit->status == 'Completed' && empty(Auth::user()->stripe_id)) {
                    $data[$k][] = '<a href="' . route("account.payment.index") . '">Add CC Info</a>';
                } else {
                    $data[$k][] = '';
                }
                if (@$trialVisit->charge_status == '1' && $trialVisit->status == 'Completed') {
                    $edit_status = "";
                    $data[$k][] = @$edit_status;
                } else {
                    $data[$k][] = '<a href="' . route("clinicalTrialRetention.edit-trial-visit", @$trialVisit->id) . '">Edit</a>';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
    }

    /**
     * Displays the  edit page of the Trial.
     *
     * @return \Illuminate\Http\Response
     */
    public function trialVisitEdit($id) {
        $trialvisits = TrialVisit::where('id', $id)->first();
        $clinicaltrials = ClinicalTrial::all();
        $researchSites = ResearchSite::all();
        return view('clinicalTrialRetention.trial-visit-edit', compact('trialvisits', 'clinicaltrials', 'researchSites'));
    }

    /**
     * Updates the Trial Information
     *
     * @return \Illuminate\Http\Response
     */
    public function trialVisitUpdate(Request $request, $id) {
        $trialvisits = TrialVisit::find($id);
        $trialvisits->patient_id = $request->get('patient_id');
        $trialvisits->clinical_id = $request->get('clinical_id');
        $trialvisits->research_site_id = $request->get('research_site_id');
        $trialvisits->visit_name = $request->get('visit_name');
        $trialvisits->date = $request->get('date');
        $trialvisits->time = $request->get('time');
        $trialvisits->status = $request->get('status');
        $trialvisits->case_note = $request->get('case_note');
        $trialvisits->save();
        return redirect()->back()->with('success', 'Trial Information Updated');
    }

    /**
      /**
     * Display a list of retained Trials.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRetention() {
        return view('clinicalTrialRetention.index', ['clinicaltrials' => ClinicalTrial::all()]);
    }

    /**
     * Display Information of Participant
     *
     * @return \Illuminate\Http\Response
     */
    public function participantInfo($id) {
        return view('clinicalTrialRetention.participant-info', ['trialvisits' => TrialVisit::find($id)]);
    }

    /**
     * Display Information of Participant
     *
     * @return \Illuminate\Http\Response
     */
    public function participantDetail($id) {
        $trialvisits = TrialVisit::find($id);
        return view('clinicalTrialRetention.participant-detail', ['trialvisits' => $trialvisits])->render();
    }

    /**
     * Display a list of retained Trials.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRetentionAjax() {
        $clinicaltrials = ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get();
        $data = [];
        foreach ($clinicaltrials as $k => $clinicaltrial) {
            $data[$k][] = $clinicaltrial->study_title;
            $data[$k][] = Carbon::parse($clinicaltrial->created_at)->format("m/d/Y");
            $data[$k][] = Carbon::parse($clinicaltrial->expiry_date)->format("m/d/Y");
            $data[$k][] = $clinicaltrial->rationale;
            $data[$k][] = '<form action="' . route("clinicalTrialRetention.create", $clinicaltrial->id) . '" method="get" id="view-form-' . $clinicaltrial->id . '">
		                   <a href="#" class="submit-trial" data-id="' . $clinicaltrial->id . '" id="submitBtn">Enrol in Retention Services</a>
                      	   <input type="submit" value="COMPLETE" id="submitBtn" class="btn-typo" style="display:none;">
			            	</form>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Display list of Upcoming Trials
     *
     * @return \Illuminate\Http\Response
     */
    public function upcomingTrials() {
        return view('clinicalTrialRetention.upcoming', ['retentionslocations' => RetentionLocation::orderBy('date', 'ASC')
                    ->orderBy('time', 'ASC')
                    ->get()]);
    }

    /**
     * Create list of Location and Patients
     *
     * @return \Illuminate\Http\Response
     */
    public function createTrial($id) {
        $retentionslocations = RetentionLocation::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get();
        $retentionspatients = RetentionPatient::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get();
        if (is_null($retentionslocations)) {
            return view('clinicalTrialRetention.create', ['clinicaltrials' => ClinicalTrial::find($id),
                'retentionspatients' => RetentionPatient::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get()]);
        } elseif (is_null($retentionspatients)) {
            return view('clinicalTrialRetention.create', ['clinicaltrials' => ClinicalTrial::find($id),
                'retentionslocations' => RetentionLocation::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get()]);
        } elseif (is_null($retentionspatients) && is_null($retentionslocations)) {
            return view('clinicalTrialRetention.create', ['clinicaltrials' => ClinicalTrial::find($id)]);
        } else {
            return view('clinicalTrialRetention.create', [
                'clinicaltrials' => ClinicalTrial::find($id),
                'retentionspatients' => RetentionPatient::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get(),
                'retentionslocations' => RetentionLocation::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get()]);
        }
    }

    /**
     * Store list of Location and Patients
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTrial(Request $request, $id) {
        if ($request->has('form1')) {
            $this->validate($request, [
                'location' => 'required',
                'date' => 'required',
                'time' => 'required',
            ]);
            $retentionlocations = new RetentionLocation([
                'user_id' => auth()->user()->id,
                'clinical_id' => $id,
                'location' => $request->get('location'),
                'date' => $request->get('date'),
                'time' => $request->get('time'),
            ]);
            $retentionlocations->save();
        }
        if ($request->has('form2')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);
            $retentionpatients = new RetentionPatient([
                'user_id' => auth()->user()->id,
                'clinical_id' => $id,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
            ]);
            $retentionpatients->save();
        }
        return view('clinicalTrialRetention.create', [
            'clinicaltrials' => ClinicalTrial::find($id),
            'retentionspatients' => RetentionPatient::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get(),
            'retentionslocations' => RetentionLocation::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->get()]);
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpcoming($id) {
        $patients = array();
        $clinicalmanages = ClinicalManage::where(['clinical_id' => $id])->get();
        $retentionspatients = RetentionPatient::where(['clinical_id' => $id])->get();
        foreach ($clinicalmanages as $clinicalmanage) {
            $clinicalmanage = array('email' => $clinicalmanage->user->email, 'name' => $clinicalmanage->user->firstname,
                'phone' => '');
            $patients[] = $clinicalmanage;
        }
        foreach ($retentionspatients as $retentionspatient) {
            $retentionspatient = array('email' => $retentionspatient->email, 'name' => $retentionspatient->name,
                'phone' => $retentionspatient->phone);
            $patients[] = $retentionspatient;
        }
        return view('clinicalTrialRetention.view', compact('patients'));
    }

    /**
     * Delete the Patient information of the Trial.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletePatient($id) {
        $retentionpatients = RetentionPatient::findorFail($id);
        $retentionpatients->delete();
        return redirect()->back();
    }

    /**
     * Delete the Location Information of the Trial.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteLocation($id) {
        $retentionslocations = RetentionLocation::findorFail($id);
        $retentionslocations->delete();
        return redirect()->back();
    }

}
