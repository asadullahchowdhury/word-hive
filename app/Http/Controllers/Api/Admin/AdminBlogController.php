<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        Blog::create($request->all());
        return response()->json([
            'message' => 'Blog created successfully',
            'blog' => Blog::latest()->first(),
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            return response()->json($blog);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $data = $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|string',
            ]);

            $blog->update($data);

            return response()->json([
                'message' => 'Blog updated successfully',
                'blog' => $blog
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found',
                'error' => $e->getMessage(),
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Blog update failed',
                'error' => $e->getMessage(),
            ], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json([
            'message' => 'Blog deleted successfully',
        ], 200);
    }
}
