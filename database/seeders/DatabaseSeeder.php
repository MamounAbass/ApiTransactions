<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $UserQuantity = 500;
        $CategoryQuantity =30;
        $ProductQuantity=1000;
        $TransactionQuantity=1000;

        User::factory($UserQuantity)->create();
        Category::factory($CategoryQuantity)->create();
        Product::factory($ProductQuantity)->create()->each( 
            function($product)
            {
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $product->categories()->attach($categories);
            });
        Transaction::factory($TransactionQuantity)->create();

    }
}
