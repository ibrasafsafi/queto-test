<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RecipeIngredientFactory extends Factory
{
  protected $model = RecipeIngredient::class;

  public function definition(): array
  {
    return [
      'recipe_id' => Recipe::factory(),
      'product_id' => Product::factory(),
      'quantity' => $this->faker->randomNumber(),
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ];
  }
}
