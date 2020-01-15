<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Profiles\CreateProfileRequest;
use DB;
use App\Http\Requests\Account\CharityRequest;
use App\Charity;
use App\Payment;
use Intervention\Image\ImageManagerStatic as Image;
use App\Bank;

class ProfilesController extends Controller {

    /**
     * Displays the profile of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($user) {
        $user = User::findorFail($user);
        return view('profiles.profile', [
            'user' => $user
        ]);
    }

    /**
     * Opens the profile page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $roles = DB::table('roles')->where('id', '!=', '1')->where('id', '!=', '8')->get();
        $profile = $request->session()->get('profile');
        $user = auth()->user();
        $profiles = Profile::where('user_id', auth()->user()->id)->get();
        if (is_null(Auth::user()->role_id)) {
            return view('profiles.create', compact('profile', 'roles', 'profiles', 'user'));
        } else {
            return redirect()->route('account.personal.index');
        }
    }

    /**
     * Opens the profile page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function skip(Request $request) {
        $url = $request->get('id');
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->role_id = $url;
        $user->save();
        return redirect()->route('account.personal.index');
    }

    /**
     * Stores the details of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = [];
        // dd($request->all());
        if ($request->role == 2) {
            $data = $this->validate($request, [
                'role' => 'required',
                'firstname' => '',
                'lastname' => '',
                'address' => '',
                'contact' => '',
                'image' => '',
                'patient_first' => '',
                'patient_last' => '',
                'patient_date' => '',
                'medical_status' => '',
                'file_name' => '',
                // 'file_name.*' => '',
                'sex_info' => '',
                'year_info' => '',
                'age_info' => '',
                'race_info' => '',
                'ethnicity_info' => '',
                'education_info' => '',
                'occupation_info' => '',
                'income_info' => '',
//                'marital_info' => '',
                'preferred_lang' => '',
                'job_title_info' => '',
                'physician_specialty' => '',
                'physician_sub_specialty' => '',
                // 'physician_medical_license' => '',
                'addmedicallicenses.*.physician_medical_license' => '',
                'addmedicalstates.*.physician_medical_state' => '',
                // 'physician_medical_state' => '',
                'physician_research' => '',
                'physician_research_experience' => '',
                'physician_therapeutic' => '',
                'physician_sub' => '',
                'physician_cv' => '',
                'physician_clinic_info' => '',
                'physician_clinic_address' => '',
                'physician_clinic_tele' => '',
                'physician_clinic_fax' => '',
                'physician_record_storage' => '',
                'clinic_person_contact' => '',
                'clinic_person_email' => '',
                'clinic_person_telephone' => '',
                'clinic_database' => '',
                'med_est_type' => '',
                'other_name' => '',
                'bank_name' => '',
                'account_number' => '',
                'routing_number' => '',
                'name_charity' => '',
                'address_charity' => '',
                    ]
            );
        } elseif ($request->role == 3 || $request->role == 4) {
            $data = $this->validate($request, [
                'role' => 'required',
                'firstname' => '',
                'lastname' => '',
                'address' => '',
                'contact' => '',
                'image' => '',
                'patient_first' => '',
                'patient_last' => '',
                'patient_date' => '',
                'patient_phy__name' => '',
                'patient_phy__email' => '',
                'patient_phy__phone' => '',
                'care_giver_name' => '',
                'care_giver_email' => '',
                'care_giver_phone' => '',
                'medical_status' => '',
                'file_name' => '',
//                'file_name.*' => '',
                'sex_info' => '',
                'year_info' => '',
                'age_info' => '',
                'race_info' => '',
                'ethnicity_info' => '',
                'education_info' => '',
                'occupation_info' => '',
                'income_info' => '',
//                'marital_info' => '',
                'preferred_lang' => '',
                'bank_name' => '',
                'account_number' => '',
                'routing_number' => '',
                'name_charity' => '',
                'address_charity' => '',
                    ]
            );
        } elseif ($request->role == 5) {
            $data = $this->validate($request, [
                'role' => 'required',
                'firstname' => '',
                'lastname' => '',
                'address' => '',
                'contact' => '',
                'image' => '',
                'job_title_info' => '',
                'sponsor_company' => '',
                'sponsor_brief' => '',
                'sponsor_per_name' => '',
                'sponsor_per_tele' => '',
                'sponsor_per_email' => '',
                'sponsor_per_address' => '',
                'sponsor_comp_tele' => '',
                'sponsor_comp_fax' => '',
                'sponsor_therapeutic' => '',
                'credit_card_info' => '',
                'ach_info' => '',
                    ]
            );
        } elseif ($request->role == 6) {
            $data = $this->validate($request, [
                'role' => 'required',
                'firstname' => '',
                'lastname' => '',
                'address' => '',
                'contact' => '',
                'image' => '',
                'job_title_info' => '',
                // 'principal_specialty' => '',
                'addmore.*.principal_specialty' => '',
                // 'principal_sub_specialty' => '',
                'addmoresubs.*.principal_sub_specialty' => '',
                'principal_medical_license' => '',
                'principal_medical_state' => '',
                'principal_research_experience' => '',
                'principal_therapeutic' => '',
                'principal_sub' => '',
                'principal_cv' => '',
                'principal_site_name' => '',
                'principal_site_address' => '',
                'principal_site_telephone' => '',
                'principal_fax' => '',
                'principal_person_company' => '',
                'principal_email' => '',
                'principal_telephone' => '',
                'credit_card_info' => '',
                'ach_info' => '',
                    ]
            );
        } elseif ($request->role == 7) {
            $data = $this->validate($request, [
                'role' => 'required',
                'firstname' => '',
                'lastname' => '',
                'address' => '',
                'contact' => '',
                'image' => '',
                'job_title_info' => '',
                'research_company' => '',
                'research_brief' => '',
                'research_per_name' => '',
                'research_per_tele' => '',
                'research_per_email' => '',
                'research_per_address' => '',
                'research_comp_tele' => '',
                'research_comp_fax' => '',
                'credit_card_info' => '',
                'ach_info' => '',
                    ]
            );
        } else {
            $data = $this->validate($request, [
                'role' => 'required',
                    ]
            );
        }

        $pro_sub_medicalno = [];
        $pro_d_medical = $request->addmedicallicenses;
        if ($pro_d_medical) {
            foreach ($pro_d_medical as $med_numbers) {
                $proaddmedicalno= $med_numbers['physician_medical_license'];
                $pro_sub_medicalno[] ="$proaddmedicalno";         
            }
            $data['physician_medical_license'] = implode(",", $pro_sub_medicalno);
        }

        $pro_sub_medicalstate = [];
        $pro_d_medical_states = $request->addmedicalstates;
        if ($pro_d_medical_states) {
            foreach ($pro_d_medical_states as $med_states) {
                $proaddmedicalstate= $med_states['physician_medical_state'];
                $pro_sub_medicalstate[] ="$proaddmedicalstate";         
            }
            $data['physician_medical_state'] = implode(",", $pro_sub_medicalstate);
        }

        $pro_add = [];
        $pro_d = $request->addmore;
        if ($pro_d) {
            foreach ($pro_d as $filess) {
                $proadd= $filess['principal_specialty'];
                $pro_add[] ="$proadd";         
            }
            $data['principal_specialty'] = implode(",", $pro_add);
        }

        $pro_sub_add = [];
        $pro_d_sub = $request->addmoresubs;
        if ($pro_d_sub) {
            foreach ($pro_d_sub as $subs) {
                $proaddsub= $subs['principal_sub_specialty'];
                $pro_sub_add[] ="$proaddsub";         
            }
            $data['principal_sub_specialty'] = implode(",", $pro_sub_add);
        }

        $medical_record = [];
        $image = $request->file('file_name');
        if ($image) {
            foreach ($image as $files) {
                $destinationPath = storage_path('medical-records/');
                $profileImage = date('YmdHis') . uniqid() . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $medical_record[] ="$profileImage";         
            }
            $data['file_name'] = implode(",", $medical_record);
        }

        // if ($request->hasFile('image')) {
        //     $filenameWithExt = $request->file('image')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
        //     $path = $request->file('image')->storeAs('public/profile-image/', $fileNameToStore);
        //     $data['image'] = $fileNameToStore;
        // } else {
        //     $fileNameToStore = '';
        // }

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
        $id = Auth::user()->id;
        $user = User::find($id);
        // $profiles = $this->uploadFiles($request);
        if (empty($request->session()->get('profile'))) {
            $profile = new Profile();
            // foreach($profiles as $profileFile)
            // {
            //     list($fileName) = $profileFile;
            //     $profile->file_name = $fileName;
            // }
            $profile->fill($data);
            $request->session()->put('profile', $profile);
        } else {
            $profile = $request->session()->get('profile');
            $profile->fill($data);
            $request->session()->put('profile', $profile);
        }
        return redirect()->route('profile.step2');
    }

    // public function removeImage(Request $request)
    // {
    //     $profile = $request->session()->get('profile');
    //     $profile->image = null;
    //      return redirect()->back();
    //     // return view('profiles.create',compact('profile', $profile));
    // }

    /**
     * Multiple File Upload
     *
     * @return \Illuminate\Http\Response
     */
    // protected function uploadFiles($request)
    // {
    //     $uploadedImages = [];
    //     if($request->hasFile('file_name'));
    //     {
    //         $profiles = $request->file('file_name');
    //         if(is_array($profiles) || is_object($profiles))
    //         {
    //              foreach($profiles as $profile)
    //              {
    //                     $uploadedImages[] = $this->uploadFile($profile);
    //              }
    //         }
    //     }
    //     return $uploadedImages;
    // }
    // protected function uploadFile($profile)
    // {
    //         $originalFileName = $profile->getClientOriginalName();
    //         $extension = $profile->getClientOriginalExtension();
    //         $fileNameOnly = pathinfo($originalFileName,PATHINFO_FILENAME);
    //         $fileName = Str::slug($fileNameOnly) . "-" . time() . "." . $extension;
    //         $uploadedFileName = $profile->storeAs('public/'.Auth::user()->id,$fileName);
    //         return [$uploadedFileName,$fileNameOnly];
    // }
    /**
     * Second Step for viewing the profile of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep2(Request $request) {
        $profile = $request->session()->get('profile');
        return view('profiles.step2', compact('profile', $profile));
    }

    /**
     * Views the profile page of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewprofile() {
        $id = Auth::user()->id;
        $user = User::find($id);
        $profile = Profile::where('user_id', auth()->user()->id)->first();
        return view('profiles.profile-view', compact('user', 'profile', 'id'));
    }

    /**
     * Store the final details of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function storestep(Request $request) {
        $profile = $request->session()->get('profile');
        // dd($profile);
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($profile->role == 1) {
            $role = "community-managers";
        } elseif ($profile->role == 2) {
            $role = "physicians";
        } elseif ($profile->role == 3 || $profile->role == 4) {
            $role = "patients";
        } elseif ($profile->role == 5 || $profile->role == 6) {
            $role = "sponsors";
        } elseif ($profile->role == 7) {
            $role = "research-coordinators";
        }
        if ($role == "physicians" || $role == "patients") {
            $charity = new Charity([
                'name' => $profile->name_charity,
                'address' => $profile->address_charity,
                'user_id' => auth()->user()->id,
            ]);
            $charity->save();
        }
        if ($role == "sponsors" || $role == "research-coordinators") {
            $paydetail = new Payment([
                'credit_card_info' => $profile->credit_card_info,
                'ach_info' => $profile->ach_info,
                'user_id' => auth()->user()->id,
            ]);
            $paydetail->save();
        }
        if ($role == "physicians" || $role == "patients") {
            $bankdetail = new Bank([
                'name' => $profile->bank_name,
                'account_number' => $profile->account_number,
                'routing_number' => $profile->routing_number,
                'user_id' => auth()->user()->id,
            ]);
            $bankdetail->save();
        }
        $user->role_id = $profile->role;
        $user->firstname = $profile->firstname;
        $user->lastname = $profile->lastname;
        $profile->user_id = auth()->user()->id;
        // $profile->is_completed = 1;
        $user->save();
        $profile->save();
        return redirect()->route('profile.thanks');
    }

    /**
     * Displays the Profile Thanks Page
     *
     * @return \Illuminate\Http\Response
     */
    public function thanks(Request $request) {
        // $request->session()->forget('profile');
        return view('profiles.thanks');
    }

    /**
     * Displays the Change Password Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm() {
        return view('profiles.change-pass');
    }

    /**
     * Displays the Change Password Page
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not match with the password you provided. Please try again.");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", "Password changed successfully !");
    }

}
