<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Comment;
use App\Models\PostLikes;
use App\Models\Visit;

class DashboardController extends Controller
{
    //get dashbord element and analytic
    public function index()
    {
        // Get the total number of posts, comments, likes, and visits.
        $TotalPosts = Post::count();
        $TotalComment = Comment::count();
        $TotalLikes = Post::sum('likes');
        $TotalVisits = Visit::count();
    
        // Get the monthly visits by year and month.
        $MonthlyVisits = Visit::select(
            DB::raw('YEAR(visit_date) as year'),
            DB::raw('MONTH(visit_date) as month'),
            DB::raw('COUNT(*) as visit_count')
        )
            ->groupBy(DB::raw('YEAR(visit_date), MONTH(visit_date)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
    
        // Convert the month number to the month name.
        foreach ($MonthlyVisits as $MonthlyVisit) {
            $monthNumber = (int)$MonthlyVisit->month;
            $monthName = Carbon::create()->month($monthNumber)->format('F');
            $MonthlyVisit->month = $monthName;
        }

        // Get the monthly posts by year and month.
        $MonthlyPosts = Post::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as post_count')
        )
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        // Convert the month number to the month name.
        foreach ($MonthlyPosts as $MonthlyPost) {
            $monthNumber = (int) $MonthlyPost->month;
            $monthName = Carbon::create()->month($monthNumber)->format('F');
            $MonthlyPost->month = $monthName;
        }

        // Get the monthly comment by year and month.
        $MonthlyComments = Comment::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as comment_count')
        )
        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
        // Convert the month number to the month name.
        foreach ($MonthlyComments as $MonthlyComment) {
            $monthNumber = (int) $MonthlyComment->month;
            $monthName = Carbon::create()->month($monthNumber)->format('F');
            $MonthlyComment->month = $monthName;
        }

        // Get the monthly Likes by year and month.
        $MonthlyLikes = PostLikes::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as likes_count')
        )
        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
        // Convert the month number to the month name.
        foreach ($MonthlyLikes as $MonthlyLike) {
            $monthNumber = (int) $MonthlyLike->month;
            $monthName = Carbon::create()->month($monthNumber)->format('F');
            $MonthlyLike->month = $monthName;
        }
        
    
        // Create the response data.
        $ResponseData = [
            "TotalPosts" => $TotalPosts,
            "TotalComment" => $TotalComment,
            "TotalLikes" => $TotalLikes,
            "TotalVisits" => $TotalVisits,
            "MonthlyVisits" => $MonthlyVisits,
            "MonthlyPosts" => $MonthlyPosts,
            "MonthlyComments" => $MonthlyComments,
            "MonthlyLikes" => $MonthlyLikes,
        ];
    
        return response()->json($ResponseData);
    }
    
    
}
