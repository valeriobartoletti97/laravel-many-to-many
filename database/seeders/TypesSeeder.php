<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\types;
use Illuminate\Support\Str;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = ['Front-end', 'Back-end', 'Full-stack'];
        foreach($types as $value){
            $newType = new types();
            $newType->slug = Str::slug($value);
            $newType->name = $value;
            $newType->save();
        }
    }
}
