<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowBook extends Model
{
    use HasFactory;

    protected $table = 'borrow_book';

    protected $fillable = [
        'name',
        'gender',
        'address',
        'phone',
        'image',
        'book_id',
        'class_id',
        'borrowed_at',
        'returned_at',
        'booking',
        'status',
    ];

    // Relationships
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function class()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }
}
