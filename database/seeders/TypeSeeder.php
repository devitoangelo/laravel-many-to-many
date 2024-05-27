<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['front-end', 'back-end', 'full-stack', 'Programming', 'Testing'];
        

        foreach ($types as $type) {

            $newTyp = new Type();
            $newTyp->name = $type;
            $newTyp->slug = Str::slug($newTyp->name, '-');
            $newTyp->save();

        }


    }
}
