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


     public function showWatchlist (Request $request) {
        //    get ID of user connecting
        $user_id = Auth::user()->id;
        // Join 3 tables "watchlist", "animes" and "users"
        $mywatchlists = DB::table('watchlists')
            ->join('animes', 'watchlists.animeid', '=', 'animes.id')
            ->join('users', 'watchlists.userid', '=', 'users.id')
            // select data corresponding to table: watchlist, animes and users
            ->select('watchlists.*', 'animes.title', 'animes.description', 'animes.cover', 'users.username')
            // find on table "watchlist" where the value of userID is same as the ID of user connecting
            ->where('watchlists.userid', $user_id)
            // get the data selected
            ->get();
        
        return view('add_to_watch_list', ["mywatchlists" => $mywatchlists]);
       
    }
   
    public function addtowatchlist($id, Request $request)
    {
        // controller
        if (!Auth::check()) 
        {
            // view
            // rediréger vers la page login si utilisateur est pas connecté 
            return redirect()->intended('/login');
        }
        // controller
        $user_id = Auth::user()->id;
       
        $checkWatchlists = DB::table('watchlists')
                    ->where('animeid', '=', $id)
                    ->where('userid', '=', $user_id)
                    // Retrieving A Single Row From A Table
                    ->first();
        // controller
        // if 
        if($checkWatchlists ===null)
        {
             // validation des données
                $validatedData = $request->validate([
                "animeid" => "required",
                "userid" => "required"
                ]);
            // modèle: add anime into watchlist
            $watchlist = new Watchlist();
            $watchlist->animeid = $validatedData["animeid"];
            $watchlist->userid = $validatedData["userid"];
            $watchlist->save();
            return redirect("/add_to_watch_list");
            
        }else {
            // afficher un erreur 
         return back()->withErrors([
            'error' => 'Anime est déja ajouté',
          ]);
        
           
        }
        // view
        return redirect("/anime/$id");
        
    }
   
}