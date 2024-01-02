<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Recipe */
class RecipeResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'recipe_ingredients' => RecipeIngredientResource::collection($this->whenLoaded('recipeIngredients'))
    ];
  }
}
