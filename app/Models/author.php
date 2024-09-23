<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    use HasFactory;

    protected $table = 'author';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'gender', 'Nationality'];



    public function author(){
        return $this->hasMany(book::class, 'author_id', 'id');
    }
}
