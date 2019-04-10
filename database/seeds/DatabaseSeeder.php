<?php

use IVSales\Comment;
use IVSales\Product;
use IVSales\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        factory(Product::class, 500)->create();
        factory(Review::class, 5000)->create();
        factory(Comment::class, 50)->create();
    }
}
