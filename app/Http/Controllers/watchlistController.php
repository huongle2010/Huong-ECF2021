<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;

class watchlistController {
    
    public function watchlists()
    {
    //     //modèle
    $watchlists = Watchlist::all();
    //     // vue
      return view('add_to_watch_list', ["watchlists" => $watchlists]);
     }


    public function addtowatch(Request $request){
        // validation des données
        $validatedData = $request->validate([
           "animeID" => "required",
           "userID" => "required"
           ]);
       // modèle
       $watchlist = new Watchlist();
       $watchlist->animeID = $validatedData["animeID"];
       $watchlist->userID = $validatedData["userID"];
       $watchlist->save();
       // ~ vue
       return redirect('/add_to_watch_list');

   }

   public function watchlist_user (Request $request) {
    //    get ID of user connecting
    $user_id = Auth::user()->id;

    // Join 3 tables "watchlist", "animes" and "users"
    $mywatchlists = DB::table('watchlists')
        ->join('animes', 'watchlists.animeID', '=', 'animes.id')
        ->join('users', 'watchlists.userID', '=', 'users.id')
        // select data corresponding to table: watchlist, animes and users
        ->select('watchlists.*', 'animes.title', 'animes.description', 'animes.cover', 'users.username')
        // find on table "watchlist" where the value of userID is same as the ID of user connecting
        ->where('watchlists.userID', $user_id)
        // get the data selected
        ->get();
    
    return view('add_to_watch_list', ["mywatchlists" => $mywatchlists]);
   
}

// Go to page "add_to_watch_list"
   public function mywatchlist()
    {
        return view('add_to_watch_list');
    }
}