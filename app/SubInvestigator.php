<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubInvestigator extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','clinical_id','status','study_title','site_name','address', 'city',
        'state','mechanism', 'list_benefits',
    ];

    /**
     * Get the User
     */
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function clinicaltrial()
    {
        return $this->belongsTo(ClinicalTrial::class,'clinical_id');
    }


}
