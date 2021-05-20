<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * LogsActivity: list all the $fillable attributes.
     */
    protected $fillable = [
        'code',
        'name',
        'description'
    ];

}
