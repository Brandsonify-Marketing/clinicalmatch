<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrialVisit extends Model {
    protected $fillable = [
    'patient_id', 'clinical_id', 'research_site_id', 'visit_name','date', 'time', 'status', 'case_note', 'user_id','charge_status',
    ];
    
    /**
     * Get the User
     */
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
      /**
     * Get the Trial
     */
    public function clinicaltrial() {
        return $this->belongsTo(ClinicalTrial::class,'clinical_id');
    }
    /**
     * Get the Trial
     */
    public function researchSite() {
        return $this->belongsTo(ResearchSite::class,'research_site_id');
    }
    /**
     * Get the patient
     */
    public function patient() {
        return $this->belongsTo(User::class,'patient_id','id');
    }
}
