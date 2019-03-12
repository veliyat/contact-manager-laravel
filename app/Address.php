<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $primaryKey = 'address_id';

    protected $fillable = [ 'type', 'address' ];
}
