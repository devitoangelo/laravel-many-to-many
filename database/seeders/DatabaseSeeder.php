<?php

namespace Database\Seeders;
use Database\Seeders\ProjectSeeder;

use Illuminate\Database\Seeder;
use Database\Seeders\TypeSeeder;
use function PHPSTORM_META\type;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {


        $this->call([
            ProjectSeeder::class,
            TypeSeeder::class,
            TechnologySeeder::class
        ]);
    }
}
