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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Cek apakah ada gambar yang diupload
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
    
            // Set session sukses
            return redirect()->route('books.index')->with('success', 'Book added successfully!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
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
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Cek apakah ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($book->image && file_exists(public_path('images/'.$book->image))) {
                unlink(public_path('images/'.$book->image));
            }

            // Upload gambar baru
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $book->image = $imageName;
        }
    
        try {
            // Update data buku
            $book->update($request->all());
    
            // Set session sukses
            return redirect()->route('books.index')->with('success', 'Book updated successfully!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('books.create')->with('error', 'Failed to update book!');
        }
    }


    public function destroy(Book $book)
    {
        try {
            $book->delete();
    
            // Set session sukses
            return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('books.index')->with('error', 'Failed to delete book!');
        }
    }
}
