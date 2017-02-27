<?php

namespace Esheinc\AuthPackage\Models;


use Illuminate\Database\Eloquent\Model;

class Admins_login extends Model
{
    protected $table = "Admins_logins";
    protected $fillable = [
        'status', 'ip', 'geo', 'language', 'device', 'os', 'browser', 'browser_version', 'agent', 'agent_version'
    ];

}