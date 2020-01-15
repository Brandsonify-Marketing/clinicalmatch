<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalTrial extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'medical_condition' => 'array',
    ];
    protected $fillable = [
        'user_id','form_type','study_title', 'private_name', 'site_name', 'phone_no', 'address', 'city','zipcode','email',
        'no_of_visits','state', 'vol_condition', 'medical_condition', 'rationale', 'sub_accept', 'drug_class',
        'mechanism','expiry_date','phase','inc_criteria', 'exc_criteria','summary_exc_inc',
        'participation','placebo', 'form_irb','enroll_status',
    ];

    /**
     * Get the User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

}
