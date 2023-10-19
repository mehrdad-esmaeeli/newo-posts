<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Post::create(['title'=>'mehrdad','sub_title'=>'esmaeeli','description'=>'mehrdad esmaeeli','slug'=>Str::slug('mehrdad')]);

       Post::factory(100)->create();
    }
}
