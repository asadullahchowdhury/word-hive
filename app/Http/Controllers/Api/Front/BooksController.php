<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all(['id', 'title', 'author', 'description', 'price', 'cover']);
        return response()->json([
            'books' => $books,
            'message' => 'Books retrieved successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $book = Book::findOrFail($id);
        return response()->json([
            'book' => $book,
            'message' => 'Book retrieved successfully',
        ], 200);
    }

    public function purchaseBook(string $id){
        $book = Book::findOrFail($id);
        $user = auth()->user();

        // Check if already purchased
        if ($user->books()->where('book_id', $id)->exists()) {
            return response()->json(['message' => 'Already purchased'], 400);
        }

        $user->books()->attach($book->id);
        $user->books()->attach($book->id, ['purchased_at' => now()]);

        return response()->json([
            'message' => 'Book purchased successfully',
            'book' => $book,
        ], 200);
    }
}
