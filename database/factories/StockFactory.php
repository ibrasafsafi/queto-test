<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StockFactory extends Factory
{
  protected $model = Stock::class;

  public function definition(): array
  {
    return [
      'user_id' => 1,
      'updated_at' => Carbon::now(),
    ];
  }
}
