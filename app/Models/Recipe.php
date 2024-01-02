<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

  protected $guarded = [];

  public function recipeIngredients(): HasMany
  {
    return $this->hasMany(RecipeIngredient::class, 'recipe_id');
  }
}
