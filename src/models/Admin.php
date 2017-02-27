<?php

namespace Esheinc\AuthPackage\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
	
	protected $table = 'Admins';

	protected $fillable = [
        'parent_id', 'level', 'status', 'username', 'password', 'first_name', 'last_name', 'email', 'last_login_at', 'last_login_ip', 'last_login_geo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];



}