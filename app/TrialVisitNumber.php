<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrialVisitNumber extends Model
{
      protected $fillable = [
    'visitor_number', 'frequency', 'research_site_id', 'user_id', 'clinical_id'
    ];
    
    /**
     * Get the User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function researchSite() {
        return $this->belongsTo(ResearchSite::class,'research_site_id');
    }
}
