<?php 

namespace Esheinc\AuthPackage\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'Admin';
	}
}