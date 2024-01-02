<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeIngredient extends Model
{
    use HasFactory;

  protected $guarded = [];

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }

  public function recipe(): BelongsTo
  {
    return $this->belongsTo(Recipe::class);
  }
}
