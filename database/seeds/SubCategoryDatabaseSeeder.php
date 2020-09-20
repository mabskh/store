<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{

    public function run()
    {
        factory(Category::class,3)->create([
            'parent_id' => $this->getRandomParentId()
        ]);
    }

    private function getRandomParentId()
    {
        return \App\Models\Category::inRandomOrder()->first();
    }

}
