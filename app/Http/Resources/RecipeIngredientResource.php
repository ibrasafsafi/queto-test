<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\RecipeIngredient */
class RecipeIngredientResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'quantity' => $this->quantity,

      'recipe_id' => $this->recipe_id,
      'product_id' => $this->product_id,

      'product' => new ProductResource($this->whenLoaded('product')),
      'recipe' => new RecipeResource($this->whenLoaded('recipe')),
    ];
  }
}
