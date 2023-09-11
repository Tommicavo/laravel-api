<?php

namespace Database\Seeders;

use App\Models\Technology;
use App\Models\Project;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        // Storage::makeDirectory('public/project_images');

        $category_ids = Type::pluck('id')->toArray();
        $technology_ids = Technology::pluck('id')->toArray();
        $user_ids = User::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $project = new Project();

            $project->type_id = Arr::random($category_ids);
            $project->user_id = Arr::random($user_ids);
            $project->title = $faker->text(20);
            $project->slug = Str::slug($project->title, '-');
            // $project->image = $faker->image(storage_path('app/public/project_images'), 250, 250);
            $project->description = $faker->paragraph(15, true);
            $project->order = $i + 1;
            $project->is_published = $faker->boolean();

            $project->save();

            $project_technologies = [];
            foreach ($technology_ids as $technology_id) {
                if ($faker->boolean()) $project_technologies[] = $technology_id;
            }

            $project->technologies()->attach($project_technologies);
        }
    }
}
