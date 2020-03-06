<?php

use Illuminate\Database\Seeder;
use App\mastermodel;

class masterseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
            $data=[
                ['id'=>1,'tag'=>"blood need"],
                ['id'=>2,'tag'=>"accident"],
                ['id'=>3,'tag'=>"helmet"],
                ['id'=>4,'tag'=>"blood want"],
                ['id'=>5,'tag'=>"two wheel accident"],
                ['id'=>6,'tag'=>"four wheel accident"],
            
            ];
            foreach ($data as $instence) 
        {
            $object=new mastermodel;
            $object->tag=$instence['tag'];
          
             $object->save();
        }

           
            
    }
}
