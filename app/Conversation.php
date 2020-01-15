<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes;
    protected $fillable = ['to','from','read_at'];
    public function fromUser() {
        return $this->belongsTo(User::class,'from');
    }
    public function toUser() {
        return $this->belongsTo(User::class,'to');
    }
}
