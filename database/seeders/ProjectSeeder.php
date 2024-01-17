<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = config('db.projects');
        foreach($data as $project){
            $new_project = new Project();
            $new_project->user_id = 1;
            $new_project->name = $project['name'];
            $new_project->language = $project['language'];
            $new_project->slug = Str::slug($project['name'].'-'.$project['language']);
            $new_project->url = $project['url'];
            $new_project->created = $project['created'];
            $new_project->commits = $project['commits'];
            $new_project->save();
        };
    }
}
