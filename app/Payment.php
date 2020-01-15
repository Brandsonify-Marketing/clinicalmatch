<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'credit_card_info', 'ach_info', 'user_id',
    ];

    /**
     * Get the Pay Details associated with the user.
     */
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
