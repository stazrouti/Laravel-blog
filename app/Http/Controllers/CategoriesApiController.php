<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;


class CategoriesApiController extends Controller
{
    //
    public function index()
    {
        $categories=categories::get();

        return response()->json($categories);
    }
}
