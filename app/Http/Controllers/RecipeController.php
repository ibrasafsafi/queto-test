<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use App\Models\StockArticle;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

  // get all recipes that can be made based on the user's stock articles and the recipe ingredients
  public function index()
  {
    $user = auth()->user();

    $recipes = Recipe::query()
      ->with('recipeIngredients:id,quantity,product_id,recipe_id', 'recipeIngredients.product:id,name')
      ->get();

    $products = StockArticle::query()
      ->whereRelation('stock', 'user_id', $user->id)
      ->selectRaw('product_id, sum(quantity) as quantity')
      ->groupBy('product_id')
      ->get()
      ->pluck('quantity', 'product_id');

    $data = $recipes->reject(function (Recipe $recipe) use ($products) {
      foreach ($recipe->recipeIngredients as $item) {
        if (!isset($products[$item->product_id]) || $products[$item->product_id] < $item->quantity) {
          return true;
        }
      }
      return false;
    });

    return RecipeResource::collection($data);

  }

  // validate if we can make this recipe based on the user's stock articles and decrease the quantity of the stock articles
  public function validateRecipe(Recipe $recipe)
  {
    $user = auth()->user();

    // if total quanty stock articles for the same product is less than the recipe ingredients qantity
    // then we can't make this recipe

    $recipe = Recipe::find($recipe->id)->load('recipeIngredients:id,quantity,product_id,recipe_id', 'recipeIngredients.product:id,name');

    $stockArticles = StockArticle::query()
      ->whereRelation('stock', 'user_id', $user->id)
      ->whereIn('product_id', $recipe->recipeIngredients->pluck('product_id'))
      ->selectRaw('product_id, sum(quantity) as quantity')
      ->groupBy('product_id')
      ->pluck('quantity', 'product_id');

    // if the stock articles are less than the recipe ingredients, then we can't make this recipe
    if ($stockArticles->isNotEmpty()) {
      foreach ($recipe->recipeIngredients as $item) {
        if (!isset($stockArticles[$item->product_id]) || $stockArticles[$item->product_id] < $item->quantity) {
          return response()->json(['message' => 'Not enough stock'], 400);
        }
      }
    }

    // create an order for this recipe & decrease the user's stock based on expires_at date of the stock article
    $ingredients = $recipe->recipeIngredients->pluck('quantity', 'product_id');

    // get the stock articles that are going to be used
    $stockArticles = StockArticle::query()
      ->whereRelation('stock', 'user_id', $user->id)
      ->whereIn('product_id', $ingredients->keys())
      ->orderBy('expiration_date')
      ->get();

    // decrease the quantity of the stock articles
    if ($ingredients->isNotEmpty()) {
      foreach ($stockArticles as $stockArticle) {
        $quantity = $ingredients[$stockArticle->product_id];
        if ($stockArticle->quantity > $quantity) {
          $stockArticle->quantity -= $quantity;
          $stockArticle->save();
          $ingredients->forget($stockArticle->product_id);
        } else {
          $quantity -= $stockArticle->quantity;
          $stockArticle->quantity = 0;
          $stockArticle->save();
          $ingredients[$stockArticle->product_id] = $quantity;
        }
      }
      return response()->json(['message' => 'Recipe validated'], 200);
    }

    return response()->json(['message' => 'Not enough stock'], 400);


  }
}
