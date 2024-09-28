<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;


class UserTypeSeeder extends Seeder
{
    //this seeder to run user types seeder

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['normal','silver','gold']; // user types to  be in the system

        //adding user types
        foreach($types as $type)
        {
            UserType::create(['name'=>$type]);
        }

    }
}
