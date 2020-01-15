<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolled extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enrolled_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','clinical_id'
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
