<?php

namespace Database\Seeders;


use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'email'     => $faker->email,
                'username'  => $faker->name,
                'password'  => bcrypt('rahasia'),
                'firstname' => $faker->firstName(),
                'lastname'  => $faker->lastName(),
            ]);
        }
    }
}
