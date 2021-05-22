<?php

namespace App\JsonApi\Stocks;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Document\ResourceObject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Models\Stock;
use App\Models\Product;

class Adapter extends AbstractAdapter
{

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Mapping of JSON API filter names to model scopes.
     *
     * @var array
     */
    protected $filterScopes = [];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Stock(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        $this->filterWithScopes($query, $filters);
    }

    /**
     * Get links related to resource.
     *
     * @return array
     */
    public function getResourceLinks($resource)
    {
        return [];
    }

    /**
     * @param Stock $stock
     * @param ResourceObject $resource
     * @return void
     */
    protected function creating(Stock $stock, ResourceObject $resource)
    {
        $stock->product()->associate($resource['products']['id']);
    }

    /**
     * @param Stock $stock
     * @param ResourceObject $resource
     * @return void
     */
    protected function created(Stock $stock, ResourceObject $resource)
    {
        $product = Product::find($resource['products']['id']);
        $product->on_hand += $stock['on_hand'];
        $product->save();
    }
}
