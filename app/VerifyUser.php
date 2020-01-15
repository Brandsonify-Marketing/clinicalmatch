<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $guarded = [];

    /**
     * Get the Verfied User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
