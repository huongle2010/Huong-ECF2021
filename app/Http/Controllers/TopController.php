<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TopController extends Controller{

    public function sortList () {
        // join 3 tables 'reviews', 'animes' and 'user'
        $toplist = DB::table('reviews')
            ->join('animes', 'reviews.animeid', '=', 'animes.id')
            ->select(array('animes.*',
                    DB::raw('round(AVG(rating),2) as ratings_average')))
        // make a group according to animes;id
            ->groupby('animes.id')
        // make a order according to rating-average from high to low 
            ->orderBy('ratings_average', 'DESC')
            ->get();
            // views
        return view('top', ["toplists" => $toplist]);
       
    }
    public function top()
    {
        return view('top');
    }

}