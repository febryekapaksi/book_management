<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = "borrowing";

    protected $fillable = ['name', 'borrow_date', 'return_date'];

    // Relasi hasMany ke BorrowingDetail
    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    // Relasi many-to-many ke Book
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowing_detail', 'borrowing_id', 'book_id');
    }
}
