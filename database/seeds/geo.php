<?php

use Illuminate\Database\Seeder;
use App\hoursmodel;

class geo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['hoursid'=>1, 'hoursstatus' =>"3", 'status' =>1],
            ['hoursid'=>2, 'hoursstatus' =>"8", 'status' =>1],
            ['hoursid'=>3, 'hoursstatus' =>"12", 'status' =>1],
            ['hoursid'=>4, 'hoursstatus' =>"24", 'status' =>1],
            ['hoursid'=>5, 'hoursstatus' =>"life_time", 'status' =>1],
        ];
        foreach ($data as $instence) 
        {
            $object=new hoursmodel;
            $object->hoursstatus=$instence['hoursstatus'];
            $object->status=$instence['status'];
            $object->save();
        }

    
    }
}
