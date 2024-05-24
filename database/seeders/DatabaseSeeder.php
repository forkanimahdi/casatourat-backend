<?php

namespace Database\Seeders;

use App\Models as models;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        models\Visitor::insert([
            [
                "first_name" => "Ahmed",
                "last_name" => "Alaoui",
                "email" => "ahmedalaoui@gmail.com",
                "token" => "Ahmed12345",
                "gender" => "male",
            ],
            [
                "first_name" => "Salma",
                "last_name" => "Alaoui",
                "email" => "salmaalaoui@gmail.com",
                "token" => "Salma12345",
                "gender" => "female",
            ],
        ]);

        models\Circuit::insert([
            [
                "name" => "Bd Mohammed V",
                "alternative" => "Bd Mohammed V Casablanca 20250",
                "description" => "some text for the circuit Mohamed V description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
            ],
            [
                "name" => "Place Mohammed V",
                "alternative" => "Place Mohammed V Casablanca 20250",
                "description" => "some text for the circuit Mohamed V description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
            ]
        ]);

        models\Building::insert([
            [
                "circuit_id" => 1,
                "name" => "jama3",
                "description" => "anthor text for the building 1 description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
                "latitude" => 33.593559,
                "longitude" => -7.606806,
            ],
            [
                "circuit_id" => 1,
                "name" => "medina",
                "description" => "anthor text for the building 1 description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
                "latitude" => 33.594651,
                "longitude" => -7.613034,
            ],
            [
                "circuit_id" => 1,
                "name" => "sa7t fna",
                "description" => "anthor text for the building 1 description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
                "latitude" => 33.595991,
                "longitude" => -7.617869,
            ],
            [
                "circuit_id" => 2,
                "name" => "sa7a",
                "description" => "anthor text for the building 1 description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
                "latitude" => 33.592974,
                "longitude" => -7.617694,
            ]
        ]);

        models\User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
        ]);
        
        models\Path::insert([
            [
                "circuit_id" => 1,
                "latitude" => 33.593601,
                "longitude" => -7.606634
            ],
            [
                "circuit_id" => 1,
                "latitude" => 33.593741,
                "longitude" => -7.608557
            ],
            [
                "circuit_id" => 1,
                "latitude" => 33.594108,
                "longitude" => -7.610533
            ],
            [
                "circuit_id" => 1,
                "latitude" => 33.594651,
                "longitude" => -7.613034
            ],
            [
                "circuit_id" => 1,
                "latitude" => 33.595325,
                "longitude" => -7.616009
            ],
            [
                "circuit_id" => 1,
                "latitude" => 33.595500,
                "longitude" => -7.617144
            ],
            [
                "circuit_id" => 1,
                "latitude" => 33.595991,
                "longitude" => -7.617869
            ],
            [
                "circuit_id" => 2,
                "latitude" => 33.592974,
                "longitude" => -7.617694
            ],
            [
                "circuit_id" => 2,
                "latitude" => 33.592849,
                "longitude" => -7.618040
            ],
            [
                "circuit_id" => 2,
                "latitude" => 33.592580,
                "longitude" => -7.618575
            ],
            [
                "circuit_id" => 2,
                "latitude" => 33.591644,
                "longitude" => -7.618890
            ],
            [
                "circuit_id" => 2,
                "latitude" => 33.590495,
                "longitude" => -7.619489
            ],
            [
                "circuit_id" => 2,
                "latitude" => 33.589982,
                "longitude" => -7.619726
            ],
            [
                "circuit_id" => 2,
                "latitude" => 33.587633,
                "longitude" => -7.621138
            ]
        ]);
    }
}
