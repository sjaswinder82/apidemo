<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $users = []; 

        for($i=0;$i<10000;$i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('111111'),    
            ];
        }
        User::insert($users);
    }
}
