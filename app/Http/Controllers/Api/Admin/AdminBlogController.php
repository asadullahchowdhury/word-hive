<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImage;
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
        $blogs = Blog::with('images')->latest()->get();
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
            'images' => 'required|array',
            'images.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);


        $blogImages = [];
        // Create image in related table
        foreach ($request->images as $image) {
            $imagePath = $image->store('blogs', 'public');
            $blogImages[] = [
                'blog_id' => $blog->id,
                'image' => $imagePath
            ];
        }

        if (count($blogImages) > 0) {
            BlogImage::insert($blogImages);
        }

        return response()->json([
            'message' => 'Blog created successfully',
            'blog' => $blog,
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
            $blog = Blog::with('images')->findOrFail($id);
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
                'images' => 'required|array',
                'images.*' => 'string',
            ]);

            $blog->update([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'description' => $data['description'],
            ]);
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $blog->images()->create(['image' => $image,]);
                }
            }

            return response()->json([
                'message' => 'Blog updated successfully',
                'blog' => $blog->load('images') // will return with related images
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
