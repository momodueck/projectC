<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;

class SearchController extends Controller
{
    public function search($term)
    {
      $songs = Song::where('title', 'like', $term.'%')
                    ->orWhere('artist', 'like', $term.'%')
                    ->distinct()
                    ->get();
      // $title_and_artists = $songs->map(function ($song) {
      //                                       return $song->title . " - " . $song->artist;
      //                                 });
      return response()->json(['songs' => $songs]);

      // return response()->json(['response' => 'test']);
    }

    public function list()
    {
      $songs = Song::all();
      return response()->json(['songs' => $songs]);

      // return response()->json(['response' => 'test']);
    }
}
