<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClinicalTrial;
use App\User;
use App\Profile;
use App\Enrolled;
use App\ResearchSite;
use App\SubInvestigator;
use App\ClinicalManage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClinicalApplication;
use App\Mail\Approve;
use App\Mail\Decline;
use App\Mail\Pending;
Use Carbon\Carbon;
use Redirect,
    Response;
use PDF;
use App\Http\Requests\ClinicalTrails\IrbRequest;
use App\Http\Requests\ClinicalTrails\NonIrbRequest;
use Illuminate\Support\Facades\DB;

class ClinicalManageController extends Controller {

    /**
     * Displays the Submit Irb Trail Page
     *
     * @return \Illuminate\Http\Response
     */
    public function createIrb() {
        $principal_investigator = @(auth()->user()->role_id == 6) ? auth()->user()->firstname . " " . auth()->user()->lastname : "";
        return view('clinicalTrialManage.add-irb', ['principal_investigator' => $principal_investigator]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request) {
        $datas = DB::table('medical_condition')
                ->select('title')
                ->get();
        $data = array();
        foreach ($datas as $medical) {
            $data[] = $medical->title;
        }
        return response()->json($data);
    }

    /**
     * Stores the Trail Irb details of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeIrb(IrbRequest $request) {
        // if ($request->hasFile('form_irb')) {
        //     $filenameWithExt = $request->file('form_irb')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('form_irb')->getClientOriginalExtension();
        //     $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
        //     $path = $request->file('form_irb')->storeAs('public/irb_forms/', $fileNameToStore);
        // } else {
        //     $fileNameToStore = '';
        // }
        $clinicaltrial = new ClinicalTrial([
            'user_id' => auth()->user()->id,
            'study_title' => $request->get('study_title'),
            'private_name' => $request->get('private_name'),
            'site_name' => $request->get('site_name'),
            'phone_no' => $request->get('phone_no'),
            'email' => $request->get('email'),
            'no_of_visits' => $request->get('no_of_visits'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'zipcode' => $request->get('zipcode'),
            'state' => $request->get('state'),
            'vol_condition' => $request->get('vol_condition'),
            'medical_condition' => $request->input('medical_condition'),
            'rationale' => $request->get('rationale'),
            'sub_accept' => $request->get('sub_accept'),
            'drug_class' => $request->get('drug_class'),
            'mechanism' => $request->get('mechanism'),
            'expiry_date' => $request->get('expiry_date'),
            'phase' => $request->get('phase'),
            'participation' => $request->get('participation'),
            'inc_criteria' => $request->get('inc_criteria'),
            'exc_criteria' => $request->get('exc_criteria'),
            'placebo' => $request->get('placebo'),
            'form_irb' => $request->get('form_irb'),
        ]);
        $clinicaltrial->form_type = 1;
        $clinicaltrial->status = 2;
        Mail::to(Auth::user()->email)->send(new ClinicalApplication($clinicaltrial));
        $clinicaltrial->save();
        $retentionlocations = new ResearchSite([
            'user_id' => auth()->user()->id,
            'clinical_id' => $clinicaltrial->id,
            'contact_email' => $request->get('email'),
            'contact_name' => $request->get('private_name'),
            'contact_phone' => $request->get('phone_no'),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'site_number' => 1,
        ]);
        $retentionlocations->save();
        if (Auth::user()->role_id == 8) {
        return redirect()->route('clinicalTrialManage.review', 'all');
        }
        else
        {
        return redirect()->route('clinicalTrialManage.create-irb')->with('success', 'New Clinical Trial Details Added');
        }
    }

    public function uploadIrb(Request $request)
    {
         $file = $request->file('form_irb');
         return $file->store('public/irb_forms');
    }

    /**
     * Displays the Submit Non Irb Trail Page
     *
     * @return \Illuminate\Http\Response
     */
    public function createNonIrb() {
        return view('clinicalTrialManage.add-non-irb');
    }

    /**
     * Stores the Non Irb details of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeNonIrb(NonIrbRequest $request) {
        $clinicaltrial = new ClinicalTrial([
            'user_id' => auth()->user()->id,
            'study_title' => $request->get('study_title'),
            'private_name' => $request->get('private_name'),
            'site_name' => $request->get('site_name'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'phone_no' => $request->get('phone_no'),
            'email' => $request->get('email'),
            'no_of_visits' => $request->get('no_of_visits'),
            'zipcode' => $request->get('zipcode'),
            'state' => $request->get('state'),
            'vol_condition' => $request->get('vol_condition'),
            'medical_condition' => $request->get('medical_condition'),
            'rationale' => $request->get('rationale'),
            'expiry_date' => $request->get('expiry_date'),
            'summary_exc_inc' => $request->get('summary_exc_inc'),
            'participation' => $request->get('participation'),
            'placebo' => $request->get('placebo'),
        ]);
        $clinicaltrial->form_type = 0;
        $clinicaltrial->status = 2;
        Mail::to(Auth::user()->email)->send(new ClinicalApplication($clinicaltrial));
        $clinicaltrial->save();
        $retentionlocations = new ResearchSite([
            'user_id' => auth()->user()->id,
            'clinical_id' => $clinicaltrial->id,
            'contact_email' => $request->get('email'),
            'contact_name' => $request->get('private_name'),
            'contact_phone' => $request->get('phone_no'),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'site_number' => 1,
        ]);
        $retentionlocations->save();
        return redirect()->route('clinicalTrialManage.review', 'all');
        // return redirect()->route('clinicalTrialManage.create-non-irb')->with('success', 'New Clinical Trial Details Added');
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function review($status) {
        if (@$status == 'all')
            return view('clinicalTrialManage.review', ['clinicaltrials' => ClinicalTrial::all()->sortByDesc("id")]);
        else
            return view('clinicalTrialManage.review', ['clinicaltrials' => ClinicalTrial::where('status', $status)->orderby('id', 'DESC')->get()]);
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF($id) {
        $clinicaltrials = ClinicalTrial::find($id);
        $pdf = PDF::loadView('clinicalTrialManage.pdf-view', compact('clinicaltrials'));
        return $pdf->download($clinicaltrials->study_title . '.pdf');
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showClinical($id) {
        $clinicaltrials = ClinicalTrial::find($id);
        return view('clinicalTrialManage.view', ['clinicaltrials' => ClinicalTrial::find($id), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Store the Status of the Trial
     *
     * @return \Illuminate\Http\Response
     */
    public function updateClinical(Request $request, $id) {
        $clinicaltrial = ClinicalTrial::find($id);
        switch ($request->input('status')) {
            case 'approve':
                $clinicaltrial->status = 1;
                Mail::to($clinicaltrial->user->email)->send(new Approve());
                $clinicaltrial->save();
                return redirect()->route('clinicalTrialManage.review', 'all');
                break;
            case 'pending':
                $clinicaltrial->status = 2;
                Mail::to($clinicaltrial->user->email)->send(new Pending());
                $clinicaltrial->save();
                break;
            case 'decline':
                $clinicaltrial->status = 3;
                // Mail::to($clinicaltrial->user->email)->send(new Decline());
                $clinicaltrial->save();
                break;
        }
        return redirect()->back()->with('success', 'Status Changed');
    }

    /**
     * Displays all Sub-Investigators
     *
     * @return \Illuminate\Http\Response
     */
    public function indexInvestigatorApplications() {
        return view('clinicalTrialManage.investigatorApplications', ['subinvestigators' => SubInvestigator::all()->sortByDesc("id")]);
    }

    /**
     * Displays all Clinical Trials for Users
     *
     * @return \Illuminate\Http\Response
     */
    public function indexInvestigatorApplicationsAjax() {
        $subinvestigators = SubInvestigator::orderByDesc('id')->get();
        $data = [];
        foreach ($subinvestigators as $k => $subinvestigator) {
            $data[$k][] = '<a  data-id="' . $subinvestigator->id . '" href="' . route("clinicalTrialManage.investigator-detail", $subinvestigator->id) . '" class="submit-trial-inv">' . @$subinvestigator->user->firstname . " " . @$subinvestigator->user->lastname . '</a>';
            $data[$k][] = Carbon::parse(@$subinvestigator->created_at)->format("m/d/Y");
            $data[$k][] = @$subinvestigator->study_title;
            $data[$k][] = @$subinvestigator->clinicaltrial->study_title;
            if (@$subinvestigator->status == 1) {
                $subinvestigator->status = "Approved";
            } elseif (@$subinvestigator->status == 2) {
                $subinvestigator->status = "Review & Approve";
            } elseif (@$subinvestigator->status == 3) {
                $subinvestigator->status = "Declined";
            } else {
                $subinvestigator->status = "Review & Approve";
            }
            $data[$k][] = '<a href="' . route("clinicalTrialManage.view-investigator", $subinvestigator->id) . '">' . @$subinvestigator->status . '</a>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**

     * Display Information of Participant

     *

     * @return \Illuminate\Http\Response

     */
    public function investigatorDetail($id) {
        $subinvestigators = SubInvestigator::find($id);
        return view('clinicalTrialManage.sub-detail', ['subinvestigators' => $subinvestigators])->render();
    }

    /**
     * Displays all Clinicals
     *
     * @return \Illuminate\Http\Response
     */
    public function indexClinicalApplications() {
        return view('clinicalTrialManage.clinicalApplications', ['clinicalmanages' => ClinicalManage::all()->sortByDesc("id")]);
    }

    /**
     * Displays all Clinical Trials for Users
     *
     * @return \Illuminate\Http\Response
     */
    public function indexClinicalApplicationsAjax() {
        $clinicalmanages = ClinicalManage::orderByDesc('id')->get();
        $data = [];
        foreach ($clinicalmanages as $k => $clinicalmanage) {
            $data[$k][] = @$clinicalmanage->user->firstname;
            $data[$k][] = Carbon::parse(@$clinicalmanage->created_at)->format("m/d/Y");
            $data[$k][] = @$clinicalmanage->lab_results;
            if (@$clinicalmanage->status == 1) {
                $clinicalmanage->status = "Approved";
            } elseif (@$clinicalmanage->status == 2) {
                $clinicalmanage->status = "Pending";
            } elseif (@$clinicalmanage->status == 3) {
                $clinicalmanage->status = "Declined";
            } else {
                $clinicalmanage->status = "Pending";
            }
            $data[$k][] = @$clinicalmanage->status;
            $data[$k][] = @$clinicalmanage->clinicaltrial->study_title;
            $data[$k][] = '<a href="' . route("clinicalTrialManage.view-trial", $clinicalmanage->id) . '">View</a>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrial($id) {
        return view('clinicalTrialManage.view-trials', ['clinicalmanages' => ClinicalManage::find($id), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Store the Status of the Trial
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTrial(Request $request, $id) {
        $clinicalmanage = ClinicalManage::find($id);
        switch ($request->input('status')) {
            case 'approve':
                $clinicalmanage->status = 1;
                Mail::to($clinicalmanage->user->email)->send(new Approve());
                $clinicalmanage->save();
                break;
            case 'pending':
                $clinicalmanage->status = 2;
                Mail::to($clinicalmanage->user->email)->send(new Pending());
                $clinicalmanage->save();
                break;
            case 'decline':
                $clinicalmanage->status = 3;
                Mail::to($clinicalmanage->user->email)->send(new Decline());
                $clinicalmanage->save();
                break;
        }
        return redirect()->back()->with('success', 'Status Changed');
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSubInvestigator() {
        return view('clinicalTrial.subapply', ['user' => Auth::user(),
            'profile' => Profile::where('user_id', auth()->user()->id)->latest('created_at')->first(),
            'clinicaltrial' => ClinicalTrial::where('user_id', auth()->user()->id)->latest('created_at')->first()]);
    }

    /**
     * Displays Subinvestigator Trials
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSubTrial($id) {
        return view('clinicalTrialManage.view-sub-trials', ['subinvestigators' => Subinvestigator::find($id)]);
    }

    /**
     * Store the Status of the Trial
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSubTrial(Request $request, $id) {
        $subinvestigator = Subinvestigator::find($id);
        switch ($request->input('status')) {
            case 'approve':
                $subinvestigator->status = 1;
                Mail::to($subinvestigator->user->email)->send(new Approve());
                $subinvestigator->save();
                break;
            case 'pending':
                $subinvestigator->status = 2;
                Mail::to($subinvestigator->user->email)->send(new Pending());
                $subinvestigator->save();
                break;
            case 'decline':
                $subinvestigator->status = 3;
                Mail::to($subinvestigator->user->email)->send(new Decline());
                $subinvestigator->save();
                break;
        }
        return redirect()->back()->with('success', 'Status Changed');
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function findtrials() {
        return view('clinicalTrial.find', ['clinicaltrials' => ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get()]);
    }

    /**
     * Displays the Review Clinical Trials Page
     *
     * @return \Illuminate\Http\Response
     */
    public function viewtrials($id) {
        return view('clinicalTrial.view', ['clinicaltrials' => ClinicalTrial::find($id), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Displays Approved Clinicals
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedTrials() {
        return view('clinicalTrialManage.approved-trials', ['clinicaltrials' => ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get()]);
    }

    /**
     * Displays Pending Clinicals
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingTrials() {
        return view('clinicalTrialManage.pending-trials', ['clinicaltrials' => ClinicalTrial::where('status', 2)->orderby('id', 'DESC')->get()]);
    }

    /**
     * Displays Declined Clinicals
     *
     * @return \Illuminate\Http\Response
     */
    public function declinedTrials() {
        return view('clinicalTrialManage.declined-trials', ['clinicaltrials' => ClinicalTrial::where('status', 3)->orderby('id', 'DESC')->get()]);
    }

    /**
     * Displays All Trials
     *
     * @return \Illuminate\Http\Response
     */
    public function manageTrials() {
        return view('clinicalTrialManage.manage-trials', ['clinicaltrials' => ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get()]);
    }

    /**
     * Displays All Trials for Searching
     *
     * @return \Illuminate\Http\Response
     */
    public function manageTrialsAjax() {
        if (Auth::user()->role_id == 8) {
            $role = "community-managers";
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4) {
            $role = "lower-levels";
        } elseif (Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7) {
            $role = "higher-levels";
        }
        if ($role == "community-managers") {
            $clinicaltrials = ClinicalTrial::where('status', 1)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($clinicaltrials as $k => $clinicaltrial) {
                $data[$k][] = '<a  data-id="' . $clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", $clinicaltrial->id) . '" class="submit-trial-detail">' . @$clinicaltrial->study_title . '</a>';
                $data[$k][] = Carbon::parse($clinicaltrial->created_at)->format("m/d/Y");
                $clinicalmanage = ClinicalManage::where('clinical_id', $clinicaltrial->id)
                        ->where('status', '=', 1)
                        ->count();
                if ($clinicalmanage == 0) {
                    $clinicalmanage = "Add";
                }
                $data[$k][] = '<a href="' . route("clinicalTrialManage.applicant-list", $clinicaltrial->id) . '">' . @$clinicalmanage . '</a>';
                $data[$k][] = (@$clinicaltrial->status == 1) ? "Published" : "Under Review";
                // $enrolled = Enrolled::where(['clinical_id' => $clinicaltrial->id, 'user_id' => auth()->user()->id])->first();
                $enrolled = ClinicalTrial::where(['id' => $clinicaltrial->id, 'user_id' => $clinicaltrial->user_id, 'enroll_status' => '1'])->first();
                if (!empty($enrolled)) {
                    $data[$k][] = 'Enrolled';
                } else {
                    $data[$k][] = '<form action="' . route("clinicalTrialManage.enroll", $clinicaltrial->id) . '" method="get" id="view-form-' . @$clinicaltrial->id . '">
                        <a href="#" class="submit-trial" data-id="' . $clinicaltrial->id . '" id="submitBtn">Sign up for retention management</a>
                        <input type="submit" value="COMPLETE" id="submitBtn" class="btn-typo" style="display:none;">
                        </form>';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
        if ($role == 'higher-levels') {
            $clinicaltrials = ClinicalTrial::where('user_id', Auth::user()->id)->where('status', 1)->orderby('id', 'DESC')->get();
            $data = [];
            foreach ($clinicaltrials as $k => $clinicaltrial) {
                $data[$k][] = '<a  data-id="' . @$clinicaltrial->id . '" href="' . route("clinicalTrialRetention.trial-detail", @$clinicaltrial->id) . '" class="submit-trial-detail">' . @$clinicaltrial->study_title . '</a>';
                $data[$k][] = Carbon::parse(@$clinicaltrial->created_at)->format("m/d/Y");
                $clinicalmanage = ClinicalManage::where('clinical_id', @$clinicaltrial->id)
                        ->where('status', '=', 1)
                        ->count();
                if ($clinicalmanage == 0) {
                    $clinicalmanage = "Add";
                }
                $data[$k][] = '<a href="' . route("clinicalTrialManage.applicant-list", $clinicaltrial->id) . '">' . @$clinicalmanage . '</a>';
                $data[$k][] = (@$clinicaltrial->status == 1) ? "Published" : "Under Review";
                // $enrolled = Enrolled::where(['clinical_id' => $clinicaltrial->id, 'user_id' => auth()->user()->id,])->first();
                $enrolled = ClinicalTrial::where(['id' => $clinicaltrial->id, 'user_id' => auth()->user()->id, 'enroll_status' => '1'])->first();
                if (!empty($enrolled)) {
                    $data[$k][] = 'Enrolled';
                } else {
                    $data[$k][] = '<form action="' . route("clinicalTrialManage.enroll", $clinicaltrial->id) . '" method="get" id="view-form-' . @$clinicaltrial->id . '">
                        <a href="#" class="submit-trial" data-id="' . $clinicaltrial->id . '" id="submitBtn">Sign up for retention management</a>
                        <input type="submit" value="COMPLETE" id="submitBtn" class="btn-typo" style="display:none;">
                        </form>';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
    }

    /**
     * Opens the profile page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function enroll(Request $request, $id) {
        $url = $request->route('id');
        $clinicaltrials = ClinicalTrial::find($id);
        $clinicaltrials->enroll_status = 1;
        $enrolled = new Enrolled([
            'user_id' => auth()->user()->id,
            'clinical_id' => $url,
        ]);
        $enrolled->save();
        $clinicaltrials->save();
        return redirect()->route('clinicalTrialManage.manage');
    }

    public function viewTrial($id) {
        return view('clinicalTrialManage.view-trial', ['clinicaltrials' => ClinicalTrial::find($id), 'profile' => Profile::where('user_id', Auth::user()->id)->first(), 'clinicalmanage' => ClinicalManage::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first(),
            'subinvestigators' => SubInvestigator::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first()]);
    }

    public function listApplicants($id) {
        $clinicalmanage = ClinicalManage::where('clinical_id', $id)
                ->where('status', '=', 1)
                ->get();
        return view('clinicalTrialManage.applicant-list', ['clinicaltrials' => ClinicalTrial::find($id), 'clinicalmanages' => ClinicalManage::where('clinical_id', $id)->where('status', '=', 1)->get(),
            'subinvestigators' => SubInvestigator::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first()]);
    }

    public function ApplicantDetail(Request $request, $id) {
        $clinicalmanages = ClinicalManage::where('user_id', $id)->first();
        return view('clinicalTrialManage.applicant-detail', ['clinicalmanages' => $clinicalmanages])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function ApplicantDetail($id)
    // {   
    //     $clinicaltrials = ClinicalTrial::find($id);
    //     $clinicalmanages = ClinicalManage::where('clinical_id', $id)->where('status', '=', 1)->get();
    //     $subinvestigators = SubInvestigator::where(['clinical_id' => $id, 'user_id' => auth()->user()->id,])->first();
    //     return Response::json(array(
    //         'clinicaltrials' => $clinicaltrials,
    //         'clinicalmanages' => $clinicalmanages,
    //         'subinvestigators' => $subinvestigators,
    //     ));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeApplicant(Request $request) {
        $userId = $request->user_id;
        if (!@$userId) {
            $already = User::where('email', $request->email)->first();
            if (@$already) {
                return Response::json(array(
                            'error' => "email already Exist"
                ));
            }
        }
        $roleId = 2;
        $statusId = 1;
        $researchsiteId = 1;
        $password = bcrypt('clinical@123');
        /*         * Added manually entry_id = 1 * */
        $entryId = 1;
        $user = User::updateOrCreate(['id' => $userId], ['firstname' => $request->firstname, 'lastname' => $request->lastname, 'email' => $request->email, 'role_id' => $roleId, 'password' => $password,
                    'entry_id' => $entryId]);
        $profile = Profile::updateOrCreate(['firstname' => $request->firstname, 'lastname' => $request->lastname, 'role' => $roleId, 'user_id' => $user['id'], 'contact' => $request->contact, 'patient_phy__name' => $request->patient_phy__name, 'patient_phy__email' => $request->patient_phy__email, 'patient_phy__phone' => $request->patient_phy__phone, 'care_giver_name' => $request->care_giver_name, 'care_giver_email' => $request->care_giver_email, 'care_giver_phone' => $request->care_giver_phone]);
        $clinicalmanage = ClinicalManage::updateOrCreate(['clinical_id' => $request->clinical_id, 'user_id' => $user['id'], 'status' => $statusId, 'research_site_id' =>
                    $researchsiteId]);
        return Response::json(array(
                    'user' => $user,
                    'profile' => $profile,
                    'clinicalmanage' => $clinicalmanage,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function editApplicant(Request $request, $id) {
        $clinicalmanages = ClinicalManage::where('user_id', $id)->first();
        $patients = array('firstname' => $clinicalmanages->user->firstname, 'lastname' => $clinicalmanages->user->lastname,
            'email' => $clinicalmanages->user->email, 'contact' => $clinicalmanages->user->profile->contact,
            'patient_phy__name' => $clinicalmanages->user->profile->patient_phy__name,
            'patient_phy__email' => $clinicalmanages->user->profile->patient_phy__email,
            'patient_phy__phone' => $clinicalmanages->user->profile->patient_phy__phone,
            'care_giver_name' => $clinicalmanages->user->profile->care_giver_name,
            'care_giver_email' => $clinicalmanages->user->profile->care_giver_email,
            'care_giver_phone' => $clinicalmanages->user->profile->care_giver_phone);
        $patients[] = $patients;
        return Response::json($patients);
    }

    /**
     * Displays all Clinicals
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewApplicants($status) {
        if (@$status == 'all')
            return view('clinicalTrialManage.review-applicants', ['clinicalmanages' => ClinicalManage::orderBy('id', 'DESC')->get()]);
        else
            return view('clinicalTrialManage.review-applicants', ['clinicalmanages' => ClinicalManage::where('status', $status)->orderby('id', 'DESC')->get()]);
        //  if (@$status == 'all')
        // $clinicalmanages = ClinicalManage::orderBy('id', 'DESC')->get();
        //  else
        // $clinicalmanages = ClinicalManage::orWhere('status', '!=', 1)->orWhereNull('status')->orderBy('id', 'DESC')->get();
        // return view('clinicalTrialManage.review-applicants', ['clinicalmanages' => $clinicalmanages,'status'=>$status]);
    }

    /**
     * Displays all Bank for ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewApplicantsAjax($status) {
        if (Auth::user()->role_id == 8) {
            if (@$status == 'all') {
                $clinicalmanages = ClinicalManage::orderBy('id', 'DESC')->get();
            } else {
                $clinicalmanages = ClinicalManage::where('status', $status)->orderby('id', 'DESC')->get();
            }
            $data = [];
            foreach ($clinicalmanages as $k => $clinicalmanage) {
                $clinical_id = $clinicalmanage->clinical_id;
                $clinicaltrialstripe = ClinicalTrial::find($clinical_id);
                $data[$k][] = '<a  data-id="' . $clinicalmanage->id . '" href="' . route("clinicalTrialManage.participant-detail", $clinicalmanage->id) . '" class="submit-trial">' . @$clinicalmanage->user->firstname . " " . @$clinicalmanage->user->lastname . '</a>';
                $data[$k][] = @$clinicalmanage->clinicaltrial->study_title;
                $data[$k][] = Carbon::parse(@$clinicalmanage->created_at)->format("m/d/Y");
                if ($clinicalmanage->status == '1') {
                    $applicant_status = "Approved";
                    $data[$k][] = $applicant_status;
                } else {
                    $data[$k][] = '<a href="' . route("clinicalTrialManage.review-applicant", $clinicalmanage->id) . '">Review & Approve</a>';
                }

                if ($clinicalmanage->charge_status == '1' && $clinicalmanage->status == '1') {
                    $charging_status = "Paid";
                    $data[$k][] = @$charging_status;
                } elseif ($clinicalmanage->user->entry_id) {
                    $charging_status = "Manual";
                    $data[$k][] = @$charging_status;
                } elseif ($clinicalmanage->status == '1' && (isset($clinicaltrialstripe->user->stripe_id) && !empty($clinicaltrialstripe->user->stripe_id))) {
                    $data[$k][] = '<form action="' . route("charge-applicant", [$clinicalmanage->id, $clinicalmanage->clinical_id]) . '" method="get" 
                                        id="view-form-pay-applicant' . $clinicalmanage->id . $clinicalmanage->clinical_id . '">
                                       <a href="#" class="submit-trial-pay-applicant" data-id="' . $clinicalmanage->id . '" 
                                       data-clinical="' . $clinicalmanage->clinical_id . '" id="submitBtnApplicant">Pay Now</a>
                                       <input type="submit" value="COMPLETE" id="submitBtnApplicant" class="btn-typo" style="display:none;">
                                       </form>';
                }
                // elseif($clinicalmanage->status=='1' && empty(Auth::user()->stripe_id) && Auth::user()->role_id==6) 
                // {
                //     $data[$k][] = '<a href="' . route("account.payment.index") . '">Add CC Info</a>';
                // } 
                elseif ($clinicalmanage->status == '1' && empty($clinicaltrialstripe->user->stripe_id)) {
                    $data[$k][] = '<a href="' . route("account.payment.add-principal", $clinicaltrialstripe->user->id) . '" data-id="' . $clinicaltrialstripe->user->id . '" >Add CC Info for this PI</a>';
                } else {
                    $data[$k][] = '';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }

        if (Auth::user()->role_id == 7 || Auth::user()->role_id == 6 || Auth::user()->role_id == 5) {
            $clinicalTrials = ClinicalTrial::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get('id');
            $mytrials = [];
            foreach ($clinicalTrials as $clinicalTrial) {
                $mytrials[] = $clinicalTrial->id;
            }
            if (@$status == 'all') {
                $clinicalmanages = ClinicalManage::whereIn('clinical_id', $mytrials)->orderBy('id', 'DESC')->get();
            } else {
                $clinicalmanages = ClinicalManage::where('status', $status)->whereIn('clinical_id', $mytrials)->orderby('id', 'DESC')->get();
            }
            $data = [];
            foreach ($clinicalmanages as $k => $clinicalmanage) {
                $data[$k][] = '<a  data-id="' . @$clinicalmanage->id . '" href="' . route("clinicalTrialManage.participant-detail", @$clinicalmanage->id) . '" class="submit-trial">' . @$clinicalmanage->user->firstname . " " . @$clinicalmanage->user->lastname . '</a>';
                $data[$k][] = @$clinicalmanage->clinicaltrial->study_title;
                $data[$k][] = Carbon::parse(@$clinicalmanage->created_at)->format("m/d/Y");
                if ($clinicalmanage->status == '1') {
                    $applicant_status = "Approved";
                    $data[$k][] = $applicant_status;
                } else {
                    $data[$k][] = '<a href="' . route("clinicalTrialManage.review-applicant", @$clinicalmanage->id) . '">Review & Approve</a>';
                }
                if ($clinicalmanage->charge_status == '1' && $clinicalmanage->status == '1') {
                    $charging_status = "Paid";
                    $data[$k][] = @$charging_status;
                } elseif ($clinicalmanage->user->entry_id) {
                    $charging_status = "Manual";
                    $data[$k][] = @$charging_status;
                } elseif (@$clinicalmanage->status == '1' && empty(Auth::user()->stripe_id)) {
                    $data[$k][] = '<a href="' . route("account.payment.index") . '">Add CC Info</a>';
                } elseif (@$clinicalmanage->status == '1' && isset(Auth::user()->stripe_id) && !empty(Auth::user()->stripe_id)) {
                    $data[$k][] = '<form action="' . route("charge-applicant", [$clinicalmanage->id, $clinicalmanage->clinical_id]) . '" method="get" 
                        id="view-form-pay-applicant' . $clinicalmanage->id . $clinicalmanage->clinical_id . '">
                       <a href="#" class="submit-trial-pay-applicant" data-id="' . $clinicalmanage->id . '" 
                       data-clinical="' . $clinicalmanage->clinical_id . '" id="submitBtnApplicant">Pay Now</a>
                       <input type="submit" value="COMPLETE" id="submitBtnApplicant" class="btn-typo" style="display:none;">
                       </form>';
                } else {
                    $data[$k][] = '';
                }
            }
            $dataArray['data'] = $data;
            print_r(json_encode($dataArray));
        }
    }

    /**

     * Display Information of Participant

     *

     * @return \Illuminate\Http\Response

     */
    public function participantDetail($id) {
        $clinicalmanages = ClinicalManage::find($id);
        return view('clinicalTrialManage.participant-detail', ['clinicalmanages' => $clinicalmanages])->render();
    }

    public function participantInfo($id) {
        return view('clinicalTrialManage.participant-info', ['clinicalmanages' => ClinicalManage::find($id)]);
    }

    /**
     * Displays all Applicants for Reviewing
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewApplicant($id) {
        return view('clinicalTrialManage.view-applicant', ['clinicalmanages' => ClinicalManage::find($id), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Store the Status of the Applicant
     *
     * @return \Illuminate\Http\Response
     */
    public function updateApplicant(Request $request, $id) {
        $clinicalmanage = ClinicalManage::find($id);
        switch ($request->input('status')) {
            case 'approve':
                $clinicalmanage->status = 1;
                $clinicalmanage->save();
                // $service_title = $request->get('service_title');
                // $service_cost = $request->get('service_cost');
                // if($clinicalmanage->status == 1)
                // {   
                //     $user = auth()->user();
                //     $todayDate = date("Y-m-d");
                //     $user->invoiceFor($service_title, $service_cost, [], [
                //         'metadata' => array("patient_name" => 'Roman',
                //                             "service_type" => 'retention',
                //                             "service_date" => $todayDate,
                //                             "cost" => '500', )
                //     ]);
                // }
                return redirect()->route('clinicalTrialManage.review-applicants', 'all');
                break;
            case 'pending':
                $clinicalmanage->status = 2;
                $clinicalmanage->save();
                break;
            case 'decline':
                $clinicalmanage->status = 3;
                $clinicalmanage->save();
                break;
        }
        return redirect()->back()->with('success', 'Status Changed');
    }

}
