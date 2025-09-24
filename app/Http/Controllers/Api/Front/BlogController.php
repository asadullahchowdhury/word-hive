<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Blog::latest()->get());
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Blog::findOrFail($id));
    }

}
