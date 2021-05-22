<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Stock;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * LogsActivity: list all the $fillable attributes.
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'deleted_at',
    ];

    /**
     * @return HasMany
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

}
