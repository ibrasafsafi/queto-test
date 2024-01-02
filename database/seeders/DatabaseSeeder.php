<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Stock;
use App\Models\StockArticle;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory(1)->create([
      'name' => 'Super Admin',
      'email' => 'admin@admin.com',
      'password' => bcrypt('password'),
      'id' => 1,
    ]);

    Product::factory(10)->create();
    Stock::factory(10)->create();
    StockArticle::factory(10)->create();
    Recipe::factory(10)->create();
    RecipeIngredient::factory(10)->create();

  }
}
