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

    /**
     * Get the value of deleted_at.
     *
     * @return string
     */
    public function getDeletedAtColumn()
    {
        return 'deleted_at';
    }

    /**
     * Get the total of on_hand.
     *
     * @return string
     */
    public function getOnHandAttribute()
    {
        return $this->stocks()->sum('on_hand');
    }

}
