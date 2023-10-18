<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;


class SearchController extends Controller
{
    public function Search(Request $request) {
        $query = $request->input('query');
        $results = post::where('title', 'like', "%$query%")
        ->orWhere('content', 'like', "%$query%")
        ->limit(5)
        ->get();
    
        // Perform a search in your database based on the $query
    
        // Return JSON response with search results
        return response()->json($results);
    }
}
