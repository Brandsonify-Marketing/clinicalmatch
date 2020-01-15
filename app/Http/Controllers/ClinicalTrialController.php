<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\ClinicalTrial;
use App\ResearchSite;
use App\SubInvestigator;
use App\ClinicalManage;
use App\SavedTrial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Requests\ClinicalManage\ClinicalRequest;
use App\Http\Requests\ClinicalManage\SubRequest;

class ClinicalTrialController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('dashboard.clinicaltrial.index', ['clinicaltrials' => ClinicalTrial::all()]);
    }

    /**
     * Displays all Clinicals
     *
     * @return \Illuminate\Http\Response
     */
    public function indexClinical() {
        return view('clinicalTrial.index', ['clinicaltrials' => ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get()]);
    }

    /**
     * Displays all Bank for ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function indexClinicalAjax() {
        if (Auth::user()->role_id == 8) {
            $role = "community-managers";
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4) {
            $role = "lower-levels";
        } elseif (Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7) {
            $role = "higher-levels";
        }
        if ($role != "higher-levels") {
            $clinicaltrials = ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($clinicaltrials as $k => $clinicaltrial) {
                $data[$k][] = '<a  data-id="' . @$clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", @$clinicaltrial->id) . '" class="submit-trial">' . @$clinicaltrial->study_title . '</a>';
                $data[$k][] = Carbon::parse(@$clinicaltrial->created_at)->format("m/d/Y");
                $data[$k][] = Carbon::parse(@$clinicaltrial->expiry_date)->format("m/d/Y");
                $data[$k][] = @$clinicaltrial->site_name;
                // $data[$k][] = Str::limit($clinicaltrial->rationale, $limit = 40, $end = '');
                if ($role == "lower-levels") {
                    $data[$k][] = '<a href="' . route("clinicalTrial.view", @$clinicaltrial->id) . '">View & Apply</a>';
                } else {
                    $data[$k][] = '';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        } else {
            $clinicaltrials = ClinicalTrial::where('user_id', Auth::user()->id)->where('status', 1)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($clinicaltrials as $k => $clinicaltrial) {
                $data[$k][] = '<a  data-id="' . $clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $clinicaltrial->id) . '" class="submit-trial">' . @$clinicaltrial->study_title . '</a>';
                $data[$k][] = Carbon::parse(@$clinicaltrial->created_at)->format("m/d/Y");
                $data[$k][] = Carbon::parse(@$clinicaltrial->expiry_date)->format("m/d/Y");
                $data[$k][] = @$clinicaltrial->site_name;
                if ($role == "lower-levels") {
                    $data[$k][] = '<a href="' . route("clinicalTrial.view", $clinicaltrial->id) . '">View & Apply</a>';
                } else {
                    $data[$k][] = '';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
//    public function indexSubInvestigator() {
//        return view('clinicalTrial.subapply', ['user' => Auth::user(),
//            'profile' => Profile::where('user_id', auth()->user()->id)->latest('created_at')->first(),
//            'clinicaltrial' => ClinicalTrial::where('user_id', auth()->user()->id)->latest('created_at')->first()]);
//    }
    public function view($id) {
        return view('clinicalTrial.view', ['clinicaltrials' => ClinicalTrial::find($id), 'profile' => Profile::where('user_id', Auth::user()->id)->first(), 'savedtrials' => SavedTrial::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first(), 'clinicalmanage' => ClinicalManage::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first(),
            'subinvestigators' => SubInvestigator::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first()]);
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request, $id) {
        $ide = Auth::user()->id;
        $user = User::find($ide);
        $profile = Profile::where('user_id', auth()->user()->id)->latest('created_at')->first();
        $clinicaltrial = ClinicalTrial::where('id', $id)->first();
        $clinicalmanages = ClinicalManage::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first();
        if (!$clinicalmanages) {
            return view('clinicalTrial.apply', compact('user', 'profile', 'clinicaltrial'));
        } else {
            
        }
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function applied(ClinicalRequest $request, $id) {
        $clinicalmanage = new ClinicalManage([
            'user_id' => auth()->user()->id,
            'clinical_id' => $id,
            'status' => $request->get('status'),
            'medical_history' => $request->get('medical_history'),
            'lab_results' => $request->get('lab_results'),
            'lab_date' => $request->get('lab_date'),
            'medications' => $request->get('medications'),
            'inc_criteria' => $request->get('inc_criteria'),
            'exc_criteria' => $request->get('exc_criteria'),
            'placebo' => $request->get('placebo'),
            'image_name' => json_encode($request->get('image_name')),
        ]);
        $clinicalmanage->save();
        return redirect()->route('clinicalTrial.index')->with('success', 'Application Completed');
    }

    public function imageup(Request $request)
    {
         $file = $request->file('image_name')[0];
         return $file->store('medical_records');
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        ClinicalManage::where('filename',$filename)->delete();
        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }

    /**
     * Saves the Clinical Trials
     *
     * @return \Illuminate\Http\Response
     */
    public function saved(Request $request, $id) {
        $savedtrial = new SavedTrial([
            'user_id' => auth()->user()->id,
            'clinical_id' => $id,
        ]);
        $savedtrial->save();
        return redirect()->back()->with('success', 'Clinical Trial Details Saved');
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function applySubInvestigator(Request $request, $id) {
        $ids = Auth::user()->id;
        $user = User::find($ids);
        $profile = Profile::where('user_id', auth()->user()->id)->latest('created_at')->first();
        $clinicaltrial = ClinicalTrial::where('id', $id)->latest('created_at')->first();
        $subinvestigators = SubInvestigator::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first();
        if (!$subinvestigators) {
            return view('clinicalTrial.subapply', compact('user', 'profile', 'clinicaltrial'));
        } else {
            
        }
    }

    /**
     * Stores the Non Irb details of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function appliedSubInvestigator(SubRequest $request, $id) {
        $subinvestigator = new SubInvestigator([
            'user_id' => auth()->user()->id,
            'clinical_id' => $id,
            'status' => $request->get('status'),
            'study_title' => $request->get('study_title'),
            'site_name' => $request->get('city'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'mechanism' => $request->get('mechanism'),
            'list_benefits' => $request->get('list_benefits'),
        ]);
        $subinvestigator->save();
        return redirect()->route('clinicalTrial.index')->with('success', 'Application Completed');
    }

    public function trialInfo($id) {
        $researchSites = ResearchSite::where(['clinical_id' => $id,])->get();
        $patient_names = ClinicalManage::where('clinical_id', $id)
                ->where('status', '=', 1)
                ->get();
//        $researchSites_data = "";
//        foreach ($researchSites as $k => $researchSite) {
//            $researchSites_data = $researchSites_data.'<option value="'. $researchSite->id .'">'. $researchSite->address.', '.$researchSite->state.', '.$researchSite->city.', '.$researchSite->zipcode.'</option>';
//        }
//        $patient_names_data = "";
        foreach ($patient_names as $k => $patient_name) {
            $patient_names[$k]['name'] =$patient_name->user->firstname.' '.$patient_name->user->lastname;
        }
        $data['research_site'] = $researchSites;
        $data['patients'] = $patient_names;
        return json_encode($data);
    }

}
