<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function create()
    {
        $books = Book::all();

        return view('borrowings.form', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'borrow_date' => 'required|date',
            'books' => 'required|array',
            'books.*' => 'exists:book,id',
        ]);

        // dd($request->all());

        $borrowing = Borrowing::create([
            'name' => $request->name,
            'borrow_date' => $request->borrow_date,
        ]);

        
        foreach ($request->books as $book_id) {
            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'book_id' => $book_id,
            ]);
        }

        return redirect()->route('borrowings.index')->with('success', 'Books borrowed successfully!');
    }

    public function index()
    {
        $borrowings = Borrowing::with('books')->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function edit($id)
    {
        $borrowing = Borrowing::with('books')->findOrFail($id); // Memuat borrowing beserta buku yang dipinjam
        $books = Book::all(); // Ambil semua buku untuk ditampilkan di dropdown
        return view('borrowings.form', compact('borrowing', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
            'books' => 'required|array',
            'books.*' => 'exists:book,id',
        ]);
        
        $borrowing->update([
            'name' => $request->name,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
        ]);

        $borrowing->books()->sync($request->books);

        return redirect()->route('borrowings.index')->with('success', 'Borrowing updated successfully!');
    }

    public function destroy(Borrowing $borrowing)
    {
        try {
            $borrowing->delete();
            return redirect()->route('borrowings.index')->with('success', 'Book deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('borrowings.index')->with('error', 'Failed to delete book!');
        }
    }
}
