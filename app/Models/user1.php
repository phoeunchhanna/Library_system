<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user1 extends Model
{
    use HasFactory;

    protected $table = 'user1';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email','password','usertype','image'];
}
