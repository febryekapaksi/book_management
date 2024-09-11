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

        // Simpan transaksi peminjaman
        $borrowing = Borrowing::create([
            'name' => $request->name,
            'borrow_date' => $request->borrow_date,
        ]);

        // Simpan buku yang dipinjam ke tabel borrowing_details
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

    public function edit(Borrowing $borrowing)
    {
        $books = Book::all();

        return view('borrowings.form', compact('borrowing', 'books'));
    }
}
