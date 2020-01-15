<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use App\Subscriber;
use App\Contact;
use Illuminate\Support\Facades\Mail;

class LandingPageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $articles = Post::where('category_id', '1')->orderby('id', 'DESC')->limit(5)->get();
        $caseStudies = Post::where('category_id', '2')->orderby('id', 'DESC')->limit(5)->get();
        return view('pages.landing', compact('articles', 'caseStudies'));
    }

    /**
     * About Page 
     * @return Illuminate\Http\Response
     */
    public function about() {
        return view('pages.about');
    }

    /**
     * Terms Page 
     * @return Illuminate\Http\Response
     */
    public function terms() {
        return view('pages.terms');
    }

    /**
     * Privacy Page 
     * @return Illuminate\Http\Response
     */
    public function privacy() {
        return view('pages.privacy');
    }

    /**
     * Service page  
     * @return \Illuminate\Http\Response
     */
    public function service() {
        return view('pages.service');
    }

    /**
     * Service detail page 
     * 
     * @return \Illuminate\Http\Response
     */
    public function serviceDetail() {
        return view('pages.service-detail');
    }

    /**
     * Service detail page 2
     * 
     * @return \Illuminate\Http\Response
     */
    public function serviceDetailDiscovery() {
        return view('pages.service-discovery-detail');
    }

    /**
     * Store subscriber
     * Used to save user subscribed 
     * 
     * @param Request $request
     * @return void 
     */
    public function subscriberStore(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:subscribers',
        ]);
        $subscriber = new Subscriber();
        $subscriber->first_name = request('first_name');
        $subscriber->last_name = request('last_name');
        $subscriber->email = request('email');
        $subscriber->save();
//        Mail::to(request('email'))->send(new UserSubscribed($subscriber));
//        Mail::to(env("ADMIN_EMAIL"))->send(new Subscribed($subscriber));
    }

    public function contactShow() {
        return view('pages.contactUs');
    }

    public function contactStore(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => '',
            'category' => 'required',
            'marketing' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = request('name');
        $contact->email = request('email');
        $contact->phone = request('phone');
        $contact->category = request('category');
        $contact->message = request('message');
        $contact->marketing = request('marketing');
        $saved = $contact->save();

        if (!$saved) {
            return redirect()->back()->with('Error', 'Error in submitting the form');
        } else {
            Mail::to(env('ADMIN_EMAIL', 'support@clinicalmatch.com'))->send(new \App\Mail\Contact($contact));
            Mail::to($contact->email)->send(new \App\Mail\UserContact($contact));
            return redirect()->back()->with('Success', 'We will ge back to you soon');
        }

//            Mail::to(env('ADMIN_EMAIL', ''))->send(new \App\Mail\Contact($contact));
//
//
//            Mail::to($contact->email)->send(new UserContact($contact));
//            return redirect()->route('thank-you');
//        }
        //  } catch(\Exception $e){
        //      dd($e);
        //      return redirect()->back()->withError('Error in submitting the form');
        //  }
    }

}
