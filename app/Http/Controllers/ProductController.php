<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockArticleResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = auth()->user();

    $products = $user->stock->products()->with('product')->get();

    return StockArticleResource::collection($products);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'product_id' => ['required', 'exists:products,id'],
      'quantity' => ['required', 'integer'],
      'expiration_date' => ['required', 'date'],
    ]);

    $record = auth()->user()->stock->products()->create($data);

    return StockArticleResource::make($record);

  }
}
