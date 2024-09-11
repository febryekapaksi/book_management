<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_date' => 'required|date',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Cek ada gambar yang diupload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName); 
        }

        $data = $request->all();
        $data['image'] = $imageName;
        // dd($data); 

        try {
            Book::create($data);
            // Book::create($request->all());

            return redirect()->route('books.index')->with('success', 'Book added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('books.create')->with('error', 'Failed to add book!');
        }
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.form', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'author' => 'required|string|max:50',
            'publisher' => 'required|string|max:50',
            'published_date' => 'required|date',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        
        if ($request->hasFile('image')) {
            if ($book->image && file_exists(public_path('images/'.$book->image))) {
                unlink(public_path('images/'.$book->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $book->image = $imageName;
        }
    
        try {
            $book->update($request->all());
    
            return redirect()->route('books.index')->with('success', 'Book updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('books.create')->with('error', 'Failed to update book!');
        }
    }


    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to delete book!');
        }
    }
}
