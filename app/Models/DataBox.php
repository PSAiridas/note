<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBox extends Model
{
    use HasFactory;
    protected $table = 'databox';
    protected $fillable = ['name','username', 'password', 'order', 'cat_id', 'user_id'];
}
