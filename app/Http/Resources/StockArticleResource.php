<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\StockArticle */
class StockArticleResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'quantity' => $this->quantity,
      'expiration_date' => $this->expiration_date,
      //      'created_at' => $this->created_at,
      //      'updated_at' => $this->updated_at,

      'product_id' => $this->product_id,
      'stock_id' => $this->stock_id,

      'product' => new ProductResource($this->whenLoaded('product')),
    ];
  }
}
