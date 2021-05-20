<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * Get the value of deleted_at.
     *
     * @return string
     */
    public function getDeletedAtColumn()
    {
        return $this->deleted_at;
    }

}
