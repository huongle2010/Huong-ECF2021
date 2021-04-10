<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class reviewController extends Controller{
    public function listReviews()
    {
    //     //modèle
    $reviews = Review::all();
    //     // vue
      return view('new_review', ["reviews" => $reviews]);
     }

    public function checkReview($id) {
        // select all data from table 'animes' at the rows with id given
        $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
        
        // get ID of user connecting
        $user_id = Auth::user()->id;

        // Select the useID and animeID exist in the table of reviews or not
        $checkReviews = DB::select("SELECT comment FROM reviews WHERE userID = $user_id AND animeID = $id");
        
        // display the view 'new_review'
        return view('new_review', ["anime" => $anime, "checkReviews" => $checkReviews]);
        } 

    public function addReviews(Request $request)
    {
        // validation of data
        $validatedData = $request->validate([
            "comment" => "required",
            "rating" => "required",
            "userID" => "required",
            "animeID" => "required"
            ]);
        // modèle: add the value from the form into the table "reviews" 
        $review = new Review();
        $review->comment = $validatedData["comment"];
        $review->rating = $validatedData["rating"];
        $review->userID = $validatedData["userID"];
        $review->animeID = $validatedData["animeID"];
        $review->save();

        // show the result
        return back()
                ->withInput()

        // show the error if the value from form is not valided
                ->withErrors([
                    'comment' => 'Comment is required.',
                    'rating' => 'Note is required.',
                  ]);
        // return response()->noContent();

    }
   


}