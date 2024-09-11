<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowingDetail;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan tahun dari request, default: tahun sekarang
        $year = $request->input('year', date('Y'));

        // Query untuk menghitung jumlah peminjaman per bulan dalam tahun yang dipilih
        $borrowings = BorrowingDetail::selectRaw('count(*) as total, MONTH(created_at) as month')
                                ->groupBy('month')
                                ->orderBy('month')
                                ->get();

        // Query untuk mendapatkan jumlah peminjaman setiap buku yang belum dikembalikan
        $bookBorrowings = BorrowingDetail::selectRaw('borrowing_detail.book_id, count(borrowing_detail.book_id) as total_borrowed')
                                        ->join('borrowing', 'borrowing_detail.borrowing_id', '=', 'borrowing.id')
                                        ->whereNull('borrowing.return_date') // Hanya yang belum dikembalikan
                                        ->groupBy('borrowing_detail.book_id')
                                        ->get();

        // Ambil data buku untuk dibandingkan dengan jumlah stok
        $books = Book::all();
        $bookData = [];

        foreach ($books as $book) {
            // Cari peminjaman setiap buku dari bookBorrowings, default 0 jika tidak ada peminjaman
            $borrowed = $bookBorrowings->firstWhere('book_id', $book->id)->total_borrowed ?? 0;
            $bookData[] = [
                'title' => $book->title,
                'borrowed' => $borrowed,
                'stock' => $book->stock,
                'percentage' => ($book->stock > 0) ? ($borrowed / $book->stock) * 100 : 0 // Hitung persentase
            ];
        }

        // Kirim data ke view
        return view('dashboard', compact('borrowings', 'year', 'bookData'));
    }
}

