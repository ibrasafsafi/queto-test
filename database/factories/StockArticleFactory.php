<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockArticle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StockArticleFactory extends Factory
{
  protected $model = StockArticle::class;

  public function definition(): array
  {
    return [
      'stock_id' => Stock::factory(),
      'quantity' => $this->faker->randomNumber(),
      'expiration_date' => Carbon::now(),
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),

      'product_id' => Product::factory(),
    ];
  }
}
