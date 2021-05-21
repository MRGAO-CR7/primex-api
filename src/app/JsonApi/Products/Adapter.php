<?php

namespace App\JsonApi\Products;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Eloquent\Concerns\SoftDeletesModels;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Models\Product;

class Adapter extends AbstractAdapter
{

    use SoftDeletesModels;

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
        parent::__construct(new Product(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if ('true' === $filters->get('withTrashed')) {
            $query->withTrashed();
            unset($filters['withTrashed']);
        } else if ('true' == $filters->get('onlyTrashed')) {
            $query->onlyTrashed();
            unset($filters['onlyTrashed']);
        }

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

}
