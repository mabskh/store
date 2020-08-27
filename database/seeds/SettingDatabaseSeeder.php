<?php
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale' => 'ar',
            'default_timezone' => 'Africa/Cairo',
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD' , 'ILS'],
            'default_currency' => 'USD',
            'store_email' => 'admin@ecommerce.com',
            'search_engine' => 'mysql',
            'local_pickup_cost' => 0,
            'free_shipping_cost' => 0,
            'outer_shipping_cost' => 0,
            'translatable' => [
                    'store_name' =>  'Golden Store',
                    'free_shipping_label' =>  'free Shipping',
                    'local_label' =>  'Local Shipping',
                    'outer_label' =>  'Outer Shipping',
            ],

        ]);
    }
}
