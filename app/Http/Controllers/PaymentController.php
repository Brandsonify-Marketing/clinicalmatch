<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use PDF;
use App\User;
use App\TrialVisit;
use App\ClinicalManage;
use App\ClinicalTrial;

class PaymentController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    /**
     * Displays Invoices
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice() {
        $user = auth()->user();
        $invoices = $user->invoicesIncludingPending();
        return view('account.payment.invoice', ['invoices' => $invoices]);
    }

    /**
     * Download Invoice Detail
     *
     * @return \Illuminate\Http\Response
     */
    public function invoiceDetail(Request $request, $invoiceId) {
        $user = auth()->user();
        return $request->user()->downloadInvoice($invoiceId, [
                    'vendor' => 'Clinical Match',
                    'product' => 'Services',
        ]);
    }

    public function charge(Request $request, $id) {
        /*         * Metadata for stripe* */
        $user = auth()->user();
        $trialvisit = TrialVisit::find($id);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $service_title = setting('payment.retention_services_title');
        $service_cost = setting('payment.retention_services_cost');
        $todayDate = date("m/d/Y");
        $user->invoiceFor($service_title, $service_cost, [], [
            'metadata' => array("patient_name" => 'Roman',
                "service_type" => $service_title,
                "service_date" => $todayDate,
                "cost" => '$' . $service_cost / 100),
        ]);
        $trialvisit->charge_status = 1;
        $trialvisit->save();
        return back();
    }

    /**
     * Charge Invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function chargeVisit(Request $request, $id, $clinicalid) {
        /*         * Metadata for stripe* */
        $user = auth()->user();
        $trialvisit = TrialVisit::find($id);
        $clinicaltrial = ClinicalTrial::find($clinicalid);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $clinicaluser = $clinicaltrial->user;
        $clinical_user_first = $clinicaltrial->user->firstname;
        $clinical_user_last = $clinicaltrial->user->lastname;
        $clinicaltitle = $clinicaltrial->study_title;
        $service_title = setting('payment.retention_services_title');
        $service_cost = setting('payment.retention_services_cost');
        /*         * Charge for Unsuccessful Invoice* */
        // $customer = \Stripe\InvoiceItem::create([
        //         'amount' => 1000,
        //         'currency' => 'usd',
        //         'customer' => 'cus_GNgy6ultiSpc0i',
        //         'description' => 'One-time setup fee',
        //         ]);
        // $user = \Stripe\Invoice::create([
        //     'customer' => 'cus_GNgy6ultiSpc0i',
        //     'collection_method' => 'send_invoice',
        //     'days_until_due' => 30,
        // ]);
        // $user->sendInvoice();
        $todayDate = date("m/d/Y");
        $clinicaluser->invoiceFor($service_title, $service_cost, [], [
            'metadata' => array("trial_name" => $clinicaltitle,
                "patient_name"=> $clinical_user_first.' '.$clinical_user_last,
                "service_type" => $service_title,
                "service_date" => $todayDate,
                "cost" => '$' . $service_cost / 100),
        ]);
        $trialvisit->charge_status = 1;
        $trialvisit->save();
        return back();
    }

    /**
     * Charge Invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function chargeApplicant(Request $request, $id, $clinicalid) {
        /*         * Metadata for stripe* */
        $user = auth()->user();
        $clinicalmanage = ClinicalManage::find($id);
        $clinicaltrial = ClinicalTrial::find($clinicalid);  
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $clinicaluser = $clinicaltrial->user;
        $clinical_user_first = $clinicaltrial->user->firstname;
        $clinical_user_last = $clinicaltrial->user->lastname;
        $clinicaltitle = $clinicaltrial->study_title;
        $todayDate = date("m/d/Y");
        $service_title_applicant = setting('payment.enrollment_services_title');
        $service_cost_applicant = setting('payment.enrollment_services_cost');
        $clinicaluser->invoiceFor($service_title_applicant, $service_cost_applicant, [], [
            'metadata' => array("trail_name" => $clinicaltitle,
                "patient_name"=> $clinical_user_first.' '.$clinical_user_last,
                "service_type" => $service_title_applicant,
                "service_date" => $todayDate,
                "cost" => '$' . $service_cost_applicant / 100,)
        ]);
        $clinicalmanage->charge_status = 1;
        $clinicalmanage->save();
        return back();
    }

    /**
     * Create Intent
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribed() {
        $user = auth()->user();
        $intent = $user->createSetupIntent();
        $paymentMethod = $user->defaultPaymentMethod();
        return view('account.payment.payment', ['intent' => $intent, 'paymentMethod' => $paymentMethod]);
    }

    /**
     * Plan Subscription
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request) {
        $user = auth()->user();
        $paymentMethod = $request->payment_method;
        $planId = $request->plan;
        $user->newSubscription('main', $planId)->create($paymentMethod);
        return response([
            'success_url' => redirect()->intended('/')->getTargetUrl(),
            'message' => 'success'
        ]);
    }

    /**
     * Add Card to Stripe
     *
     * @return \Illuminate\Http\Response
     */
    public function addCard(Request $request) {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $hello = \Stripe\Customer::retrieve(auth()->user()->stripe_id);
            $customer = Customer::createSource(
                            auth()->user()->stripe_id, ['source' => $request->stripeToken]
            );
            $custhello = Customer::allSources(
                            auth()->user()->stripe_id, ['object' => 'list']
            );
            // $charge = Charge::create(array(
            //     'customer' => $customer->id,
            //     'amount' => 50000,
            //     'currency' => 'usd',
            //     'metadata' => array("patient_name" => 'Shamsheer',
            //                      "service_type" => 'retention',
            //                      "service_date" => '4th Feb',
            //                      "cost" => '15', )
            // ));
            // $customer = Customer::create(array(
            //     'email' => $request->stripeEmail,
            //     'source' => $request->stripeToken
            // ));
            return redirect()->route('account.payment.index')->with('success', 'New Payment Details Added');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Add Customer to Stripe
     *
     * @return \Illuminate\Http\Response
     */
    public function addCustomer(Request $request) {
        try {
            $user = auth()->user();
            $firstname = auth()->user()->firstname;
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $user->createAsStripeCustomer([
                'description' => 'Clinical Match',
                'name' => $firstname,
            ]);
            $user = Customer::createSource(
                            auth()->user()->stripe_id, ['source' => $request->stripeToken]
            );
            return redirect()->route('account.payment.index')->with('success', 'New Customer Details Added');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Add Customer to Stripe
     *
     * @return \Illuminate\Http\Response
     */
    public function addPrincipalCustomer(Request $request, $id) {
        try {
            $principal = User::where('id', $id)->first();
            $firstname = $principal->firstname;
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $principal->createAsStripeCustomer([
                'description' => 'Clinical Match',
                'name' => $firstname,
            ]);
            $principal = Customer::createSource(
                            $principal->stripe_id, ['source' => $request->stripeToken]
            );
            return redirect()->route('clinicalTrialRetention.trial-visit');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function addPrincipalCard(Request $request, $id) {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $hello = \Stripe\Customer::retrieve(auth()->user()->stripe_id);
            $customer = Customer::createSource(
                            auth()->user()->stripe_id, ['source' => $request->stripeToken]
            );
            $custhello = Customer::allSources(
                            auth()->user()->stripe_id, ['object' => 'list']
            );
            return redirect()->route('account.payment.index')->with('success', 'New Payment Details Added');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display Transaction History
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionHistory(Request $request, $status) {
        $user = auth()->user();
        if (@$status == 'all') {
            $invoices = $user->invoicesIncludingPending();
            return view('account.payment.transactions', ['invoices' => $invoices]);
        } else if (@$status == '1') {
            $invoices = $user->invoices();
            return view('account.payment.transactions', ['invoices' => $invoices]);
        } else if (@$status == '2') {
            $allinvoices = $user->invoicesIncludingPending();
            $invoices = array();
            foreach ($allinvoices as $invoice) {
                if ($invoice->paid == false) {
                    $invoices[] = $invoice;
                }
            }
            return view('account.payment.transactions', ['invoices' => $invoices]);
        } else {
            $invoices = $user->invoicesIncludingPending();
            return view('account.payment.transactions', ['invoices' => $invoices]);
        }
    }

    /**
     * Display Transaction Information
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionDetail(Request $request, $invoiceId) {
        $user = auth()->user();
        $invoices = $user->findInvoice($invoiceId);
        return view('account.payment.transaction-detail', ['invoices' => $invoices])->render();
    }

    /**
     * Download Transaction History 
     *
     * @return \Illuminate\Http\Response
     */
    public function export_pdf() {
        $user = auth()->user();
        $invoices = $user->invoicesIncludingPending();
        $pdf = PDF::loadView('account.payment.transaction-pdf', compact('invoices'));
        return $pdf->download('transactions.pdf');
    }

}
