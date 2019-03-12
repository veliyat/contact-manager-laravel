<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    //
    protected $table = 'phone_numbers';

    protected $primaryKey = 'phone_id';

    protected $fillable = [ 'phone' ];
}
