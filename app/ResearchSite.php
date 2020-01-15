<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchSite extends Model
{
    protected $fillable = [
        'site_number', 'contact_name', 'contact_email','contact_phone', 'address', 'city', 'state', 'zipcode', 'date', 'time', 'user_id', 'clinical_id', 
    ];

    /**
     * Get the User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
