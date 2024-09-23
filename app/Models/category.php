<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;


    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'title'];

    public function category(){
        return $this->hasMany(book::class, 'category_id', 'id');
    }
}
