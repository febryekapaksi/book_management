<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    use HasFactory;
    protected $table = "borrowing_detail";
    protected $fillable = ['borrowing_id', 'book_id'];

     // Relasi belongsTo ke Borrowing
     public function borrowing()
     {
         return $this->belongsTo(Borrowing::class);
     }
 
     // Relasi belongsTo ke Book
     public function book()
     {
         return $this->belongsTo(Book::class);
     }
}
