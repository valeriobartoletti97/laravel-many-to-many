<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
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
            $newType = new Type();
            $newType->slug = Str::slug($value);
            $newType->name = $value;
            $newType->save();
        }
    }
}
