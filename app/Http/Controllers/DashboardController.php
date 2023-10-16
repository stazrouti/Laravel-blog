<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Comment;
use App\Models\PostLikes;
use App\Models\Visit;

class DashboardController extends Controller
{
    //get dashbord element and analytic
    public function index()  {

        $TotalPosts = post::count();
        $TotalComment = Comment::count();
        $TotalLikes = post::sum('likes');
        $TotalVisits = visit::count();

        $MonthlyVisits = Visit::select(
            DB::raw('YEAR(visit_date) as year'),
            DB::raw('MONTH(visit_date) as month'),
            DB::raw('COUNT(*) as visit_count')
        )
        ->groupBy(DB::raw('YEAR(visit_date), MONTH(visit_date)'))
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $ResponseData =[ 
            "TotalPosts" => $TotalPosts,
            "TotalComment" => $TotalComment,
            "TotalLikes" => $TotalLikes,
            "TotalVisits" => $TotalVisits,
            "MonthlyVisits" => $MonthlyVisits,

        ];
        $A="hello";
        return  response()->json($ResponseData);
    }
}
