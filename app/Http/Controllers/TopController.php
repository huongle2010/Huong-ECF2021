<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TopController extends Controller{

    public function sortList () {
        $toplist = DB::table('reviews')
            ->join('animes', 'reviews.animeID', '=', 'animes.id')
            ->select(array('animes.*',
                    DB::raw('round(AVG(rating),2) as ratings_average')))
            ->groupby('animeID')
            ->orderBy('ratings_average', 'DESC')
            ->get();
        return view('top', ["toplists" => $toplist]);
       
    }
    public function top()
    {
        return view('top');
    }

}