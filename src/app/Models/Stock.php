<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Stock extends Model
{
    use HasFactory;

    /**
     * JSON API fields that are fillable into a record.
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'on_hand',
        'taken',
        'production_date',
    ];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
