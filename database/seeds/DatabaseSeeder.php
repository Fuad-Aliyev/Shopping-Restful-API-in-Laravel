<?php

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $userQTY = 100;
        $transactionQTY = 900;
        $categoryQTY = 40;
        $productQTY = 800;

        factory(User::class, $userQTY)->create();
        factory(Category::class, $categoryQTY)->create();
        factory(Product::class, $productQTY)->create()->each(function($product) {

        	$categories = Category::all()->random(mt_rand(1, 10))->pluck('id');

        	$product->categories()->attach($categories);
        });

        factory(Transaction::class, $transactionQTY)->create();
    }
}
