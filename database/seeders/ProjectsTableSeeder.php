<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Functions\Helper;
use App\Models\Technology;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 100; $i++){
            $new_project = new Project();
            //associo randomicamente una tech al post
            $new_project->technology_id=Technology::inRandomOrder()->first()->id;
            $new_project -> title = $faker -> sentence();
            $new_project -> slug = Helper::generateSlug($new_project->title, Project::class);
            $new_project -> save();
        }
    }
}
