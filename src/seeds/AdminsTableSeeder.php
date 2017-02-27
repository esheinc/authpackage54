<?php

use Esheinc\AuthPackage\Models\admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ip = geoip()->getClientIP();
        $geo = geoip()->getLocation($ip);


        $root = admin::create([
            'parent_id' => 0,
            'level' => 0,
            'status' => 1,
            'username' => 'r00t4adm1n',
            'password' => bcrypt('h3uy2faGqy1UUqc0'),
            'first_name' => 'Alex',
            'last_name' => 'Scalia',
            'email' => 'alex@alexscalia.com',
            'last_login_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
            'last_login_geo' => $geo->iso_code,
        ]);
    }
}
