<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {

            $project = new Project();
            $project->title = $faker->words(4, true);
            $project->cover_image = $faker->imageUrl(600, 300, true, $project->title, true, 'jpg');
            $project->slug = str::of($project->title)->slug('-');
            $project->content = $faker->text(400);
            $project->save();

       
        }
    }
}
