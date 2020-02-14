<?php

use Illuminate\Database\Seeder;
use App\geoadmin;
class geoadminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['username'=>"ganesh", 'password' =>"ganesh3"],
       
       ];
       foreach ($data as $instence) 
       {
           $object=new geoadmin;
           $object->username=$instence['username'];
           $object->password=$instence['password'];
           $object->save();
          }
}
}