<?php

use Illuminate\Database\Seeder;
use App\User;
class geoadminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id' =>"1",
            'name' => "ajith",
            'password' => bcrypt("123456"),
            'mobile_no' => "9629877005",
            'isadmin' => 1
        ]); 
}
}