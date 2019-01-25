<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'email', 'name', 'password', 'address', 'zipcode', 'city', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
