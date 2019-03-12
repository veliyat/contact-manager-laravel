<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [ 'first_name', 'last_name', 'email', 'picture' ];

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function phone() {
        return $this->hasOne(Phone::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
