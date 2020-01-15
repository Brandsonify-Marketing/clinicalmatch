<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'account_number', 'routing_number', 'location', 'account_type', 'account_info','status','user_id',
    ];

    /**
     * Get the Pay Details associated with the user.
     */
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
