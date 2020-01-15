<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalManage extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','clinical_id','status','medical_history','lab_results','lab_date', 'medications',
        'inc_criteria','exc_criteria', 'placebo','charge_status','image_name',
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

}
