<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $table = 'book';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'category_id',
        'author_id',
        'personalize',
        'image'
    ];

    public function Category()
    {
        return $this->belongsTo(category::class);
    }
    public function Author()
    {
        return $this->belongsTo(author::class);
    }
}
