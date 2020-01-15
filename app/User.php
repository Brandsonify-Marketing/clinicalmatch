<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','image', 'provider', 'provider_id', 'email', 'password','subscribed','role_id','entry_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the Verified User
     */
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    /**
     * Get the Profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    /**
     * Get the Charities associated with the user.
     */
    public function charities()
    {
      return $this->hasMany(Charity::class);
    }

    /**
     * Get the Pay Details associated with the user.
     */
    public function paydetails()
    {
      return $this->hasMany(Payment::class);
    }

    /**
     * Get the Clinical Trails associated with the user.
     */
    public function clinicaltrails()
    {
      return $this->hasMany(ClinicalTrail::class);
    }
    /**
     * Get the Clinical Trails associated with the user.
     */
    public function subinvestigator()
    {
      return $this->hasMany(Subinvestigator::class);
    }
    /**
     * Get the Clinical Trails associated with the user.
     */
    public function savedtrials()
    {
      return $this->hasMany(SavedTrial::class);
    }

    public function trialvisits()
    {
      return $this->hasMany(TrialVisit::class);
    }
}
