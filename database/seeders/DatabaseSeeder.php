<?php

namespace Database\Seeders;

use App\Models as models;
use Carbon\Carbon;
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
        models\User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
        ]);

        models\Visitor::insert([
            [
                "first_name" => "Ahmed",
                "last_name" => "Alaoui",
                "email" => "ahmedalaoui@gmail.com",
                "token" => "user_2h8hFGAhZ0PSDW5ZXhwshjotNAC",
                "gender" => "male",
                "role" => "admin",
            ],
        ]);

        models\Circuit::insert([
            [
                "name" => "Bd Mohammed V",
                "alternative" => "Bd Mohammed V Casablanca 20250",
                "description" => "some text for the circuit Mohamed V description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
                'published' => true
            ],
            [
                "name" => "Place Mohammed V",
                "alternative" => "Place Mohammed V Casablanca 20250",
                "description" => "some text for the circuit Mohamed V description and much more",
                "audio" => "1715861706-dgMt0eAw6X0TgojlYeQvqyCaYsMv6POFChfVi80s.mp3",
                'published' => true
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

        models\Event::insert([[
            'title' => "Les Journées du Patrimoine de Casablanca 13ème édition",
            'description' => "La 13e édition des Journées du Patrimoine de Casablanca auront lieu du 13 au 19 mai 2024. Une invitation à voyager dans le temps et l'espace, révélant la splendeur architecturale et urbanistique de la métropole à travers 5 circuits guidés et une programmation culturelle d'une richesse inégalée, sous le thème évocateur de \"Casablanca, patrimoine en mouvement\".",
            'start' => Carbon::now(),
            'end' => Carbon::now(),
            'image' => "event1.jpg",
        ], [
            'title' => "fdjhc",
            'description' => "fdjhc",
            'start' => Carbon::now(),
            'end' => Carbon::now(),
            'image' => "event1.jpg",
        ]]);
    }
}
