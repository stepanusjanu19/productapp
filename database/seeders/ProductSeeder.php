<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create([
            'product_category_id' => 1,
            'name'=>'kursi',
            'price' => '1000000',
            'image' => 'https://uwitan.id/wp-content/uploads/2018/06/1.-Furniture-Kursi-Classic-Chair-Natural.jpeg'
        ]);
    }
}
