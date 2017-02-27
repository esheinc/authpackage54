<?php

namespace Esheinc\AuthPackage\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'iso', 'name'
    ];

}
