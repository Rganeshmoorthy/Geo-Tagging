<?php

use Illuminate\Database\Seeder;
use App\model\sammodel;

class geotag extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' =>1, 'name' => "Draft", 'email' => "a@gmail.com"],
            ['id' =>2,'name' => "Sent", 'email' => "b@gmail.com"],
            ['id' =>3,'name' => "Paid", 'email' => "c@gmail.com"],
              
           ];
            //$invoice_status_master = invoice_status_master::create($data);       
           foreach ($data as $instence) {
               $object = new sammodel;
               $object->name = $instence['name'];
               $object->email = $instence['email'];
               $object->save();
           }
    
    }
}
