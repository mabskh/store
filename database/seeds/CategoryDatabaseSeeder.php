<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryDatabaseSeeder extends Seeder
{

    public function run()
    {
        factory(Category::class,20)->create();
    }

}
