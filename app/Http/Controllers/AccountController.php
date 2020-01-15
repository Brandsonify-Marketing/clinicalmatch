<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Charity;
use App\Payment;
use App\Bank;
use App\ClinicalManage;
use App\ClinicalTrial;
use App\SavedTrial;
use App\SubInvestigator;
Use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Account\CharityRequest;
use App\Http\Requests\Account\PaymentRequest;
use App\Http\Requests\Account\BankRequest;
use App\Http\Requests\Account\PersonalRequest;
use App\Http\Requests\Account\ProfessionalRequest;
use App\Http\Requests\Account\PatientRequest;

class AccountController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /** Charity Module */

    /**
     * Displays the account of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardaccount() {
        return view('dashboard.account.account', ['clinicalmanages' => ClinicalManage::where('user_id', Auth::user()->id)->get(), 'subinvestigators' => SubInvestigator::where('user_id', Auth::user()->id)->get()]);
    }

    /**
     * Displays Clinical Trials of the User
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardaccountAjax() {
        $clinicalmanages = ClinicalManage::where('user_id', Auth::user()->id)->get();
        $data = [];
        foreach ($clinicalmanages as $k => $clinicalmanage) {
            $data[$k][] = $clinicalmanage->user->firstname;
            $data[$k][] = Carbon::parse($clinicalmanage->created_at)->format("m-d-Y");
            $data[$k][] = $clinicalmanage->clinicaltrial->study_title;
            if ($clinicalmanage->status == 1) {
                $clinicalmanage->status = "Approved";
            } elseif ($clinicalmanage->status == 2) {
                $clinicalmanage->status = "Pending";
            } elseif ($clinicalmanage->status == 3) {
                $clinicalmanage->status = "Declined";
            } else {
                $clinicalmanage->status = "Pending";
            }
            $data[$k][] = $clinicalmanage->status;
            $data[$k][] = $clinicalmanage->clinicaltrial->study_title;
            $data[$k][] = '<a href="' . route("account.view-trial", $clinicalmanage->id) . '">View</a>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Displays the Trial View Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrial($id) {
        return view('dashboard.account.view-trial', ['clinicalmanages' => ClinicalManage::find($id), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Displays the Sub Investigator Applications of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function subinvestigator() {
        return view('dashboard.account.sub-investigator', ['subinvestigators' => SubInvestigator::where('user_id', Auth::user()->id)->get()]);
    }

    /**
     * Displays Subinvestigator Applications of the User
     *
     * @return \Illuminate\Http\Response
     */
    public function subinvestigatorAjax() {
        $subinvestigators = SubInvestigator::where('user_id', Auth::user()->id)->get();
        $data = [];
        foreach ($subinvestigators as $k => $subinvestigator) {
            $data[$k][] = $subinvestigator->user->firstname;
            $data[$k][] = Carbon::parse($subinvestigator->created_at)->format("m-d-Y");
            $data[$k][] = $subinvestigator->study_title;
            if ($subinvestigator->status == 1) {
                $subinvestigator->status = "Approved";
            } elseif ($subinvestigator->status == 2) {
                $subinvestigator->status = "Pending";
            } elseif ($subinvestigator->status == 3) {
                $subinvestigator->status = "Declined";
            } else {
                $subinvestigator->status = "Pending";
            }
            $data[$k][] = $subinvestigator->status;
            $data[$k][] = $subinvestigator->clinicaltrial->study_title;
            $data[$k][] = '<a href="' . route("account.view-sub-trial", $subinvestigator->id) . '">View</a>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Displays the Trial View Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showSubTrial($id) {
        return view('dashboard.account.view-sub-trial', ['subinvestigators' => Subinvestigator::find($id)]);
    }

    /**
     * Displays the Saved Applications of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function saved() {
        return view('dashboard.account.saved', ['savedtrials' => SavedTrial::where('user_id', Auth::user()->id)->get()]);
    }

    /**
     * Displays Clinical Trials of the User
     *
     * @return \Illuminate\Http\Response
     */
    public function savedAjax() {
        $savedtrials = SavedTrial::where('user_id', Auth::user()->id)->get();
        $data = [];
        foreach ($savedtrials as $k => $savedtrial) {
            $data[$k][] = $savedtrial->user->firstname;
            $data[$k][] = Carbon::parse($savedtrial->created_at)->format("m-d-Y");
            $data[$k][] = $savedtrial->clinicaltrial->study_title;
            $data[$k][] = '<a href="' . route("account.view-saved-trial", $savedtrial->id) . '">View</a>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Displays the Trial View Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showSavedTrial($id) {
        return view('dashboard.account.view-saved-trial', ['savedtrials' => SavedTrial::find($id)]);
    }

    /**
     * Displays all Charities
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCharity() {
        return view('account.charity.index', ['charities' => Charity::where('user_id', Auth::user()->id)->get()]);
    }

    /**
     * Displays all Bank for ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCharityAjax() {
        $charities = Charity::where('user_id', Auth::user()->id)->get();
        $data = [];
        foreach ($charities as $k => $charity) {
            $data[$k][] = $charity->name;
            $data[$k][] = $charity->address;
            $data[$k][] = $charity->amount;
            $data[$k][] = $charity->ach;
            $data[$k][] = '<a href="' . route("account.charity.edit", $charity->id) . '">Update Your Charity</a>';
            $data[$k][] = '<form action="' . route("account.charity.delete", $charity->id) . '" method="post">
                           ' . csrf_field() . ' 
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Displays the Add Page of Charity.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCharity() {
        return view('account.charity.add');
    }

    /**
     * Stores the new Charity details of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeCharity(CharityRequest $request) {
        $charity = new Charity([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'amount' => $request->get('amount'),
            'ach' => $request->get('ach'),
            'user_id' => Auth::user()->id,
        ]);
        $charity->save();
        return redirect()->route('account.charity.index')->with('success', 'New Charity Added');
    }

    /**
     * Displays the charity edit page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editCharity($id) {
        $charity = Charity::where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->first();
        return view('account.charity.edit', compact('charity', 'id'));
    }

    /**
     * Edit the charity information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCharity(CharityRequest $request, $id) {
        $charity = Charity::find($id);
        $charity->name = $request->get('name');
        $charity->address = $request->get('address');
        $charity->amount = $request->get('amount');
        $charity->ach = $request->get('ach');
        $charity->save();
        return redirect()->route('account.charity.index')->with('success', 'Charity updated!');
    }

    /**
     * Delete the charity information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyCharity($id) {
        $charity = Charity::findorFail($id);
        $charity->delete();
        return redirect()->route('account.charity.index')->with('success', 'Charity has been deleted!!');
    }

    /** Bank module */

    /**
     * Displays the Add Page of Banking.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBank() {
        return view('account.bank.add');
    }

    /**
     * Stores the new Payment details of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeBank(BankRequest $request) {
        $bankdetail = new Bank([
            'name' => $request->get('name'),
            'account_number' => $request->get('account_number'),
            'routing_number' => $request->get('routing_number'),
            'location' => $request->get('location'),
            'account_type' => $request->get('account_type'),
            'account_info' => $request->get('account_info'),
            'status' => $request->get('status'),
            'user_id' => Auth::user()->id,
        ]);
        $bankdetail->save();
        return redirect()->route('account.bank.index')->with('success', 'New Details Added');
    }

    /**
     * Displays the Banking edit page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editBank($id) {
        $bankdetail = Bank::where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->first();
        return view('account.bank.edit', compact('bankdetail', 'id'));
    }

    /**
     * Edit the Banking information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBank(BankRequest $request, $id) {
        $bankdetail = Bank::find($id);
        $bankdetail->name = $request->get('name');
        $bankdetail->account_number = $request->get('account_number');
        $bankdetail->routing_number = $request->get('routing_number');
        $bankdetail->location = $request->get('location');
        $bankdetail->account_type = $request->get('account_type');
        $bankdetail->account_info = $request->get('account_info');
        $bankdetail->status = $request->get('status');
        $bankdetail->save();
        return redirect()->route('account.bank.index')->with('success', 'Payment Details updated!');
    }

    /**
     * Displays all Banking
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBank() {
        return view('account.bank.index', ['banks' => Bank::where('user_id', Auth::user()->id)->get()]);
    }

    /**
     * Displays all Bank for ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBankAjax() {
        $banks = Bank::where('user_id', Auth::user()->id)->get();
        $data = [];
        foreach ($banks as $k => $bank) {
            $data[$k][] = '<span class="bank_info">Name</span>' . $bank->name;
            $data[$k][] = '<span class="bank_info">Account Number</span>' . $bank->account_number;
            $data[$k][] = '<span class="bank_info">Routing Number</span>' . $bank->routing_number;
            $data[$k][] = '<span class="bank_info">Location</span>' . $bank->location;
            $data[$k][] = '<span class="bank_info">Account Type</span>' . $bank->account_type;
            $data[$k][] = '<a href="' . route("account.bank.edit", $bank->id) . '">Update Your Bank</a>';
            $data[$k][] = '<form action="' . route("account.bank.delete", $bank->id) . '" method="post">
                           ' . csrf_field() . ' 
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>';
        }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Delete the Banking information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyBank($id) {
        $bankdetail = Bank::findorFail($id);
        $bankdetail->delete();
        return redirect()->route('account.bank.index')->with('success', 'Bank Details has been deleted!!');
    }

    /** Payment Details */

    /**
     * Displays all Payments
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPayment() {
        if (auth()->user()->stripe_id) {
            return view('account.payment.index', ['payments' => Payment::where('user_id', Auth::user()->id)->get()]);
        } else {
            return view('account.payment.add');
        }
    }

    /**
     * Displays all Payments
     *
     * @return \Illuminate\Http\Response
     */
    public function addPrincipalPayment() {
        return view('account.payment.add-principal');
    }

    /**
     * Displays all Payment for ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPaymentAjax() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        if (auth()->user()->stripe_id) {
            $card_details = Customer::allSources(
                            auth()->user()->stripe_id, ['object' => 'card']
            );
            $payments = Payment::where('user_id', Auth::user()->id)->get();
            $dc = $card_details->data;
            $data = [];
            $card_count = count($card_details->data);
            foreach ($dc as $k => $value) {
                $data[$k][] = @$value->brand;
                $data[$k][] = @$value->last4;
                $data[$k][] = @$value->exp_month;
                $data[$k][] = @$value->exp_year;
                if (@$card_count == 1) {
                    $data[$k][] = '';
                } else {
                    $data[$k][] = '<form action="' . route("account.payment.delete", $value->id) . '" method="post">
                                ' . csrf_field() . ' 
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Delete</button>
                               </form>';
                }
            }
        } else {
            $data = [];
        }
        // $payments = Payment::where('user_id', Auth::user()->id)->get();
        // $data=[];
        // foreach ($payments as $k => $payment) {
        //     $data[$k][] = $payment->credit_card_info;
        //     $data[$k][] = $payment->ach_info;
        //     $data[$k][] = '<a href="' . route("account.payment.edit", $payment->id) . '">Update Your Payment</a>';
        //     $data[$k][] = '<form action="'.route("account.payment.delete", $payment->id) .'" method="post">
        //                    '.csrf_field().' 
        //                     <input name="_method" type="hidden" value="DELETE">
        //                     <button class="btn btn-danger" type="submit">Delete</button>
        //                 </form>';
        // }
        $dataArray['data'] = $data;
        print_r(json_encode($dataArray));
    }

    /**
     * Displays the Add Page of Payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPayment() {
        return view('account.payment.add');
    }

    /**
     * Stores the new Payment details of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function storePayment(PaymentRequest $request) {
        $paydetail = new Payment([
            'credit_card_info' => $request->get('credit_card_info'),
            'ach_info' => $request->get('ach_info'),
            'user_id' => Auth::user()->id,
        ]);
        $user_id = Auth::user()->id;
        $user = User::findorFail($user_id);
        $user = new User([
            'user_id' => Auth::user()->id,
            'email' => Auth::user()->email,
        ]);
        $user->createAsStripeCustomer();
        $paydetail->save();
        return redirect()->route('account.payment.index')->with('success', 'New Details Added');
    }

    /**
     * Displays the Payment edit page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPayment($id) {
        $paydetail = Payment::where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->first();
        return view('account.payment.edit', compact('paydetail', 'id'));
    }

    /**
     * Edit the Payment information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatepayment(PaymentRequest $request, $id) {
        $paydetail = Payment::find($id);
        $paydetail->credit_card_info = $request->get('credit_card_info');
        $paydetail->ach_info = $request->get('ach_info');
        $paydetail->save();
        return redirect()->route('account.payment.index')->with('success', 'Payment Details updated!');
    }

    /**
     * Delete the payment information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyPayment($id) {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Customer::deleteSource(
                            auth()->user()->stripe_id, $id
            );
            return redirect()->route('account.payment.index')->with('success', 'Payment Details Deleted');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
        // $paydetail = Payment::findorFail($id);
        // $paydetail->delete();
        // return redirect()->route('account.payment.index')->with('success', 'Payment Details has been deleted!!');
    }

    /**
     * Displays the professional information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProfessional() {
        return view('account.professional.index', ['user' => Auth::user(), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Displays the professional edit page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfessional() {
        return view('account.professional.edit', ['user' => Auth::user(), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Edit the professional information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfessional(Request $request) {
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        if (!isset($profile) || is_null($profile)) {
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
        }
        if (Auth::user()->role_id == 7) {
            $this->validate($request, [
                'job_title_info' => 'required|max:255',
                'research_company' => 'required|max:255',
                'research_brief' => 'required|max:255',
                'research_per_name' => 'required|max:255',
                'research_per_tele' => 'required|max:255',
                'research_per_email' => 'required|email|max:255',
                'research_per_address' => 'required|max:255',
                'research_comp_tele' => 'required|max:255',
                'research_comp_fax' => 'required|max:255',
            ]);
            $profile->job_title_info = $request->get('job_title_info');
            $profile->research_company = $request->get('research_company');
            $profile->research_brief = $request->get('research_brief');
            $profile->research_per_name = $request->get('research_per_name');
            $profile->research_per_tele = $request->get('research_per_tele');
            $profile->research_per_email = $request->get('research_per_email');
            $profile->research_per_address = $request->get('research_per_address');
            $profile->research_comp_tele = $request->get('research_comp_tele');
            $profile->research_comp_fax = $request->get('research_comp_fax');
        }

        if (Auth::user()->role_id == 6) {
            $this->validate($request, [
                'job_title_info' => 'required|max:255',
                // 'principal_specialty' => 'required|max:255',
                'addmore.*.principal_specialty' => '',
                'addmoresubs.*.principal_sub_specialty' => '',
                // 'principal_sub_specialty' => 'required|max:255',
                'principal_medical_license' => 'required|max:255',
                'principal_medical_state' => 'required|max:255',
                'principal_research_experience' => 'required|max:255',
                'principal_therapeutic' => 'required|max:255',
                'principal_sub' => 'required',
                // 'principal_cv' => 'required | mimes:jpeg,jpg,png | max:2000',
                'principal_cv' => '',
                'principal_site_name' => 'required|max:255',
                'principal_site_address' => 'required|max:255',
                'principal_site_telephone' => 'required|max:255',
                'principal_fax' => 'required|max:255',
                'principal_person_company' => 'required|max:255',
                'principal_email' => 'required|email|max:255',
                'principal_telephone' => 'required|max:255',
            ]);
            if ($request->hasFile('principal_cv')) {
                $filenameWithExt = $request->file('principal_cv')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('principal_cv')->getClientOriginalExtension();
                $principal = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = $request->file('principal_cv')->storeAs('public/principal-cv/', $principal);
                $data['principal_cv'] = $principal;
            } else {
                $principal = '';
            }

            $pro_add = [];
            $pro_d = $request->addmore;
            if ($pro_d) {
                foreach ($pro_d as $filess) {
                    $proadd = $filess['principal_specialty'];
                    $pro_add[] = "$proadd";
                }
                $profile->principal_specialty = implode(",", $pro_add);
            }

            $pro_sub_add = [];
            $pro_d_sub = $request->addmoresubs;
            if ($pro_d_sub) {
                foreach ($pro_d_sub as $subs) {
                    $proaddsub = $subs['principal_sub_specialty'];
                    $pro_sub_add[] = "$proaddsub";
                }
                $profile->principal_sub_specialty = implode(",", $pro_sub_add);
            }
            $profile->job_title_info = $request->get('job_title_info');
            // $profile->principal_specialty = $request->get('principal_specialty');
            // $profile->principal_sub_specialty = $request->get('principal_sub_specialty');
            $profile->principal_medical_license = $request->get('principal_medical_license');
            $profile->principal_medical_state = $request->get('principal_medical_state');
            $profile->principal_research_experience = $request->get('principal_research_experience');
            $profile->principal_therapeutic = $request->get('principal_therapeutic');
            $profile->principal_sub = $request->get('principal_sub');
            $profile->principal_cv = $principal;
            $profile->principal_site_name = $request->get('principal_site_name');
            $profile->principal_site_address = $request->get('principal_site_address');
            $profile->principal_site_telephone = $request->get('principal_site_telephone');
            $profile->principal_fax = $request->get('principal_fax');
            $profile->principal_person_company = $request->get('principal_person_company');
            $profile->principal_email = $request->get('principal_email');
            $profile->principal_telephone = $request->get('principal_telephone');
        }

        if (Auth::user()->role_id == 5) {
            $this->validate($request, [
                'job_title_info' => 'required|max:255',
                'sponsor_company' => 'required|max:255',
                'sponsor_brief' => 'required|max:255',
                'sponsor_per_name' => 'required|max:255',
                'sponsor_per_tele' => 'required|max:255',
                'sponsor_per_email' => 'required|email|max:255',
                'sponsor_per_address' => 'required|max:255',
                'sponsor_comp_tele' => 'required|max:255',
                'sponsor_comp_fax' => 'required |max:255',
                'sponsor_therapeutic' => 'required|max:255',
            ]);
            $profile->job_title_info = $request->get('job_title_info');
            $profile->sponsor_company = $request->get('sponsor_company');
            $profile->sponsor_brief = $request->get('sponsor_brief');
            $profile->sponsor_per_name = $request->get('sponsor_per_name');
            $profile->sponsor_per_tele = $request->get('sponsor_per_tele');
            $profile->sponsor_per_email = $request->get('sponsor_per_email');
            $profile->sponsor_per_address = $request->get('sponsor_per_address');
            $profile->sponsor_comp_tele = $request->get('sponsor_comp_tele');
            $profile->sponsor_comp_fax = $request->get('sponsor_comp_fax');
            $profile->sponsor_therapeutic = $request->get('sponsor_therapeutic');
        }


        if (Auth::user()->role_id == 2) {
            $this->validate($request, [
                'job_title_info' => 'required|max:255',
                'physician_specialty' => 'required|max:255',
                'physician_sub_specialty' => 'required|max:255',
                // 'physician_medical_license' => 'required|max:255',
                // 'physician_medical_state' => 'required|max:255',
                'addmedicallicenses.*.physician_medical_license' => '',
                'addmedicalstates.*.physician_medical_state' => '',
                'physician_research' => 'required|max:255',
                'physician_research_experience' => '',
                'physician_therapeutic' => '',
                'physician_sub' => 'required',
                // 'physician_cv' => 'required | mimes:jpeg,jpg,png | max:2000',
                'physician_cv' => '',
                'physician_clinic_info' => 'required|max:255',
                'physician_clinic_address' => 'required|max:255',
                'physician_clinic_tele' => 'required|max:255',
                'physician_clinic_fax' => 'required|max:255',
                'physician_record_storage' => 'required|max:255',
                'clinic_person_contact' => 'required|max:255',
                'clinic_person_email' => 'required|email|max:255',
                'clinic_person_telephone' => 'required|max:255',
                'clinic_database' => 'required|max:255',
                'med_est_type' => 'required',
                'other_name' => '',
            ]);
            if ($request->hasFile('physician_cv')) {
                $filenameWithExt = $request->file('physician_cv')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('physician_cv')->getClientOriginalExtension();
                $physician = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = $request->file('physician_cv')->storeAs('public/physician-cv/', $physician);
                $data['physician_cv'] = $physician;
            } else {
                $physician = '';
            }
            $pro_sub_medicalno = [];
            $pro_d_medical = $request->addmedicallicenses;
            if ($pro_d_medical) {
                foreach ($pro_d_medical as $med_numbers) {
                    $proaddmedicalno = $med_numbers['physician_medical_license'];
                    $pro_sub_medicalno[] = "$proaddmedicalno";
                }
                $profile->physician_medical_license = implode(",", $pro_sub_medicalno);
            }

            $pro_sub_medicalstate = [];
            $pro_d_medical_states = $request->addmedicalstates;
            if ($pro_d_medical_states) {
                foreach ($pro_d_medical_states as $med_states) {
                    $proaddmedicalstate = $med_states['physician_medical_state'];
                    $pro_sub_medicalstate[] = "$proaddmedicalstate";
                }
                $profile->physician_medical_state = implode(",", $pro_sub_medicalstate);
            }

            $profile->job_title_info = $request->get('job_title_info');
            $profile->physician_specialty = $request->get('physician_specialty');
            $profile->physician_sub_specialty = $request->get('physician_sub_specialty');
            // $profile->physician_medical_license = $request->get('physician_medical_license');
            // $profile->physician_medical_state = $request->get('physician_medical_state');
            $profile->physician_research = $request->get('physician_research');
            $profile->physician_research_experience = $request->get('physician_research_experience');
            $profile->physician_therapeutic = $request->get('physician_therapeutic');
            $profile->physician_sub = $request->get('physician_sub');
            $profile->physician_cv = $physician;
            $profile->physician_clinic_info = $request->get('physician_clinic_info');
            $profile->physician_clinic_address = $request->get('physician_clinic_address');
            $profile->physician_clinic_tele = $request->get('physician_clinic_tele');
            $profile->physician_clinic_fax = $request->get('physician_clinic_fax');
            $profile->physician_record_storage = $request->get('physician_record_storage');
            $profile->clinic_person_contact = $request->get('clinic_person_contact');
            $profile->clinic_person_email = $request->get('clinic_person_email');
            $profile->clinic_person_telephone = $request->get('clinic_person_telephone');
            $profile->clinic_database = $request->get('clinic_database');
            $profile->med_est_type = $request->get('med_est_type');
            $profile->other_name = $request->get('other_name');
        }
        $profile->save();
        return redirect()->route('account.professional.index')->with('success', 'Profile Details has been updated!');
    }

    /**
     * Displays the patient information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPatient() {
//        dd(Profile::where('user_id', Auth::user()->id)->first());
        return view('account.patient.index', ['profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Displays the patient edit page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPatient() {
        return view('account.patient.edit', ['profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Edit the patient information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePatient(PatientRequest $request) {
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        if (!isset($profile) || is_null($profile)) {
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
        }
        $profile->patient_first = $request->get('patient_first');
        $profile->patient_last = $request->get('patient_last');
        $profile->patient_date = $request->get('patient_date');
        $profile->patient_phy__name = $request->get('patient_phy__name');
        $profile->patient_phy__email = $request->get('patient_phy__email');
        $profile->patient_phy__phone = $request->get('patient_phy__phone');
        $profile->care_giver_name = $request->get('care_giver_name');
        $profile->care_giver_email = $request->get('care_giver_email');
        $profile->care_giver_phone = $request->get('care_giver_phone');
        $profile->race_info = $request->get('race_info');
        $profile->sex_info = $request->get('sex_info');
        $profile->age_info = $request->get('age_info');
        $profile->year_info = $request->get('year_info');
        $profile->preferred_lang = $request->get('preferred_lang');
        $profile->education_info = $request->get('education_info');
//        $profile->marital_info = $request->get('marital_info');
        $profile->ethnicity_info = $request->get('ethnicity_info');
        $profile->occupation_info = $request->get('occupation_info');
        $profile->income_info = $request->get('income_info');
        $profile->save();
        return redirect()->route('account.patient.index')->with('success', 'Patients Details has been updated!');
    }

    /**
     * Displays the personal information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPersonal() {
        return view('account.personal.index', ['user' => Auth::user(), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Displays the edit page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPersonal() {
        return view('account.personal.edit', ['user' => Auth::user(), 'profile' => Profile::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Edit the personal information of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePersonal(PersonalRequest $request) {

        $user = Auth::user();
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        // $user->email = $request->get('email');
        $user->save();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        if (!isset($profile) || is_null($profile)) {
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
        }
        $profile->address = $request->get('address');
        $profile->contact = $request->get('contact');
        // if($request->hasFile('image')) {        
        //     $filenameWithExt = $request->file('image')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $fileNameToStore = $filename.'_'.date('mdYHis').uniqid().'.'.$extension;                       
        //     $path = $request->file('image')->storeAs('public/profile-image/',$fileNameToStore);
        //     $data['image']=$fileNameToStore;
        // } 
        // else 
        // {
        // $fileNameToStore = '';
        // }
        // $profile->image = $fileNameToStore;
        $profile->image = $request->get('image');
        $profile->save();
        return redirect()->route('account.personal.index')->with('success', 'Profile Details has been updated!');
    }

    public function imageup(Request $request) {
        if($request->hasFile('image')) 
        {  
            $file = $request->file('image');
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/profile-image/', $fileNameToStore);
            return $data['image'] = $fileNameToStore;
        }
        if($request->hasFile('principal_cv')) {  
            $file = $request->file('principal_cv');
            $filenameWithExt = $request->file('principal_cv')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('principal_cv')->getClientOriginalExtension();
            $principal = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
            $path = $request->file('principal_cv')->storeAs('public/principal-cv/', $principal);
            return $data['principal_cv'] = $principal;
        }
        if($request->hasFile('physician_cv')) 
        {  
            $file = $request->file('physician_cv');
            $filenameWithExt = $request->file('physician_cv')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('physician_cv')->getClientOriginalExtension();
            $physician = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
            $path = $request->file('physician_cv')->storeAs('public/physician-cv/', $physician);
            return $data['physician_cv'] = $physician;
        }
        else
        {
            
        }
    }

    // public function uploadPrincipal(Request $request) {
    //     if($request->hasFile('principal_cv')) {  
    //         $file = $request->file('principal_cv');
    //         $filenameWithExt = $request->file('principal_cv')->getClientOriginalName();
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         $extension = $request->file('principal_cv')->getClientOriginalExtension();
    //         $principal = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
    //         $path = $request->file('principal_cv')->storeAs('public/principal-cv/', $principal);
    //         return $data['principal_cv'] = $principal;
    //     }
    // }
    // public function uploadPhysician(Request $request) {
    //     $file = $request->file('physician_cv');
    //     $filenameWithExt = $request->file('physician_cv')->getClientOriginalName();
    //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //     $extension = $request->file('physician_cv')->getClientOriginalExtension();
    //     $physician = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
    //     $path = $request->file('physician_cv')->storeAs('public/physician-cv/', $physician);
    //     return $data['physician_cv'] = $physician;
    // }

}
