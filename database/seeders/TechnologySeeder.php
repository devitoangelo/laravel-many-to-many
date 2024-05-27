<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $technologys = ['html', 'css', 'php', 'vue', 'js', 'ml', 'ai', 'gpt', 'gemini'];

            foreach($technologys as $technology) {

                $newTechnology = new Technology();
                $newTechnology->name = $technology;
                $newTechnology->slug = Str::slug($newTechnology->name, '-');
                $newTechnology->save();

            }
    }
}
