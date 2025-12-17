<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'        => 'Oxford White Shirt',
                'description' => 'Classic white oxford shirt for formal occasions.',
                'category_id' => '1',
                'price'       => '150',
                'image'       => 'https://images.unsplash.com/photo-1598033129183-c4f50c717658?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name'        => 'Blue Denim Shirt',
                'description' => 'Rugged blue denim shirt for a casual look.',
                'category_id' => '1',
                'price'       => '200',
                'image'       => 'https://images.unsplash.com/photo-1589310243389-96a5483213a8?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name'        => 'Black Casual Shirt',
                'description' => 'Versatile black shirt that fits every style.',
                'category_id' => '2',
                'price'       => '250',
                'image'       => 'https://images.unsplash.com/photo-1617114919297-3c8ddb01f599?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name'        => 'Flannel Plaid Shirt',
                'description' => 'Warm and comfortable flannel shirt with plaid pattern.',
                'category_id' => '3',
                'price'       => '300',
                'image'       => 'https://images.unsplash.com/photo-1594932224828-b4b057b99c15?q=80&w=800&auto=format&fit=crop',
            ],
        ]);
    }
}
