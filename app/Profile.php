<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role','firstname','lastname','address','contact','image','sex_info','year_info','age_info','race_info','ethnicity_info','education_info','occupation_info','income_info',
        'marital_info','preferred_lang','patient_first','patient_last','patient_date','patient_phy__name','patient_phy__email','patient_phy__phone','care_giver_name','care_giver_email',
        'care_giver_phone','clinical_status','medical_status','file_name','company_info','job_title_info','principal_specialty',
        'principal_sub_specialty','principal_medical_license','principal_medical_state','principal_research_experience','principal_therapeutic','principal_sub','principal_cv',
        'principal_site_name','principal_site_address','principal_site_telephone','principal_fax','principal_person_company','principal_email','principal_telephone','research_company',
        'research_brief','research_per_name','research_per_tele','research_per_email','research_per_address','research_comp_tele','research_comp_fax','research_therapeutic',
        'sponsor_company','sponsor_brief','sponsor_per_name','sponsor_per_tele','sponsor_per_email','sponsor_per_address','sponsor_comp_tele','sponsor_comp_fax','sponsor_therapeutic',
        'physician_specialty','physician_sub_specialty','physician_medical_license','physician_medical_state','physician_research','physician_research_experience','physician_therapeutic',
        'physician_sub','physician_cv','physician_clinic_info','physician_clinic_address','physician_clinic_tele','physician_clinic_fax','physician_record_storage',
        'clinic_person_contact','clinic_person_email','clinic_person_telephone','clinic_database','med_est_type','other_name','credit_card_info','ach_info','bank_name','account_number',
        'routing_number','name_charity','address_charity','is_completed'
    ];

    /**
     * Get the User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
