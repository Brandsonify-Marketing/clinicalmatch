<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $fillable = [
        'name', 'address', 'amount', 'user_id','ach',
      ];


     /**
     * Get the Charity Details associated with the user.
     */
      public function user()
      {
         return $this->belongsTo(User::class);
      }


}
