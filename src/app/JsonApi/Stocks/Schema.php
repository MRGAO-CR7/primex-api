<?php

namespace App\JsonApi\Stocks;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'stocks';

    /**
     * @var array The attributes which should not be included.
     */
    private $attributeBlacklist = [
        'id'
    ];

    /**
     * @param \App\Stock $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Stock $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        $attributes['on_hand'] = (string) $resource['on_hand'];
        $attributes['taken'] = (string) $resource['taken'];
        $attributes['production_date'] = (string) $resource['production_date'];
        $attributes['created_at'] = (string) $resource['created_at'];
        $attributes['updated_at'] = (string) $resource['updated_at'];

        return array_diff_key($attributes, array_flip($this->attributeBlacklist), $resource->getRelations());
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
     * @param Stock $resource
     * @param bool $isPrimary
     * @param array $includeRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'products' => [
                self::SHOW_SELF => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA => true,
                self::DATA => function () use ($resource) {
                    return $resource->product;
                },
            ],
        ];
    }
}
