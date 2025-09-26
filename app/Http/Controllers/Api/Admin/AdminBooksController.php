<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'title' => 'required|string',
                'author' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'pdf' => 'required|file|mimes:pdf|max:2048',
                'category_id' => 'nullable|exists:categories,id',
            ])->validated();

            $book = new Book();
            $book->title = $validated['title'];
            $book->author = $validated['author'];
            $book->price = $validated['price'];
            $book->description = $validated['description'];
            $book->cover = $validated['cover'];
            $book->pdf = $validated['pdf'];
            $book->category_id = $validated['category_id'];
            $book->save();

            return response()->json([
                'message' => 'Book created successfully',
                'book' => $book,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = Validator::make($request->all(), [
                'title' => 'required|string',
                'author' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'pdf' => 'required|file|mimes:pdf|max:2048',
                'category_id' => 'nullable|exists:categories,id',

            ])->validated();

            $book = Book::findOrFail($id);
            $book->update([
                'title' => $validated['title'],
                'author' => $validated['author'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'cover' => $validated['cover'],
                'pdf' => $validated['pdf'],
                'category_id' => $validated['category_id'],
            ]);

            return response()->json([
                'message' => 'Book updated successfully',
                'book' => $book,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return response()->json([
                'message' => 'Book deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
