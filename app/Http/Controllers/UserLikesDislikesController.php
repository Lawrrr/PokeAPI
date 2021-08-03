<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UserLikesDislikes;
use Illuminate\Http\Request;

class UserLikesDislikesController extends Controller
{
  public function likePokemon (Request $request)
  {
    $fields = $request->validate([
      'pokemon_name' => 'required'
    ]);

    $user = Auth::user();

    if ($user) {
      $getPokemon = UserLikesDislikes::where('user_id', $user->id)
                                ->where('is_liked', 1)
                                ->get();
      $pokemonCount = count($getPokemon);

      if ($pokemonCount < 3) {
        $likedPokemon = UserLikesDislikes::updateOrCreate(
          [
            'user_id' => $user->id,
            'pokemon_name' => $fields['pokemon_name']
          ],
          [
            'is_liked' => 1,
            'is_disliked' => 0
          ]
        );
  
        $response = [
          "liked" => $likedPokemon,
          "message" => "You have liked this Pokemon"
        ];
      } else {
        $response = [
          "message" => "You can only like up to 3 Pokemons"
        ];
      }
    } else {
      $response = [
        "message" => "User not found..."
      ];
    }

    return response($response);
  }

  public function dislikePokemon (Request $request)
  {
    $fields = $request->validate([
      'pokemon_name' => 'required'
    ]);

    $user = Auth::user();

    if ($user) {
      $getPokemon = UserLikesDislikes::where('user_id', $user->id)
                                ->where('is_disliked', 1)
                                ->get();
      $pokemonCount = count($getPokemon);

      if ($pokemonCount < 3) {
        $dislikedPokemon = UserLikesDislikes::updateOrCreate(
          [
            'user_id' => $user->id,
            'pokemon_name' => $fields['pokemon_name'],
          ],
          [
            'is_disliked' => 1,
            'is_liked' => 0
          ]
        );
  
        $response = [
          "liked" => $dislikedPokemon,
          "message" => "You have disliked this Pokemon"
        ];
      } else {
        $response = [
          "message" => "You can only dislike up to 3 Pokemons"
        ];
      }
    } else {
      $response = [
        "message" => "User not found..."
      ];
    }

    return response($response);
  }

  public function remove(Request $request)
  {
    $fields = $request->validate([
      'pokemon_name' => 'required'
    ]);

    $user = Auth::user();

    if ($user) {
      $getPokemon = UserLikesDislikes::where('user_id', $user->id)
                                      ->where('pokemon_name', $fields['pokemon_name'])
                                      ->first();
      if ($getPokemon) {
        $getPokemon->delete();

        $response = [
          "message" => "Pokemon removed successfully!"
        ];
      } else {
        $response = [
          "message" => "Data does not exist"
        ];
      }
    } else {
      $response = [
        "message" => "User not found..."
      ];
    }

    return response($response);
  }
}
