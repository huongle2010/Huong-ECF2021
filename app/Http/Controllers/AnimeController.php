<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class AnimeController {
    public function selectList (){
        $animes = DB::select("SELECT * FROM animes");
        return view('welcome', ["animes" => $animes]);
    }

    public function showReview ($id) {
      
        $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];

        // join 3 tables 'reviews', 'animes' and 'user'
        $reviews = DB::table('reviews')
            ->join('animes', 'reviews.animeID', '=', 'animes.id')
            ->join('users', 'reviews.userID', '=', 'users.id')
            ->select('reviews.*', 'animes.title', 'animes.description', 'users.username')
            ->where('reviews.animeID', $id)
            ->get();

        // calculate the average of rating
        $avg_rating = round($reviews->avg('rating'), 2);
        
        return view('anime', ["reviews" => $reviews, "anime" => $anime, "avg_rating" => $avg_rating, 
                                ]);
       
    }
    
    

  
    
    
}