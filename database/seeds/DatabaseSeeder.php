<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SettingDatabaseSeeder::class);   //SettingDatabaseSeeder
         $this->call(AdminDatabaseSeeder::class);     //AdminDatabaseSeeder
         $this->call(CategoryDatabaseSeeder::class);  //CategoryDatabaseSeeder
         $this->call(ProductDatabaseSeeder::class);  //CategoryDatabaseSeeder
         //$this->call(SubCategoryDatabaseSeeder::class);  //SubCategoryDatabaseSeeder
    }
}
