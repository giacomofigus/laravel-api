<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 10; $i++){
            $project = new Project();

            $project->name = $faker->sentence(3);
            $project->description = $faker->text(500);
            $project->slug = Str::slug($project->name, '-');

            $project->save();
        }
    }
}
