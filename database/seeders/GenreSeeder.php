<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $genres = [
            'Azione',
            'Commedia',
            'Drammatico',
            'Horror',
            'Fantascienza',
            'Fantasy',
            'Thriller',
            'Romantico',
            'Animazione',
            'Documentario',
        ];

        foreach ($genres as $genreName) {

            $newGenre =new Genre();
            $newGenre->name = $genreName;

            $newGenre->save();
           
        }
    }
}
