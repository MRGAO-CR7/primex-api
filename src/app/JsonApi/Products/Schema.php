<?php

namespace App\JsonApi\Products;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'products';

    /**
     * @var array The attributes which should not be included.
     */
    private $attributeBlacklist = [
        'id'
    ];

    /**
     * @param \App\Product $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Product $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        $attributes['code'] = (string) $resource['code'];
        $attributes['name'] = (string) $resource['name'];
        $attributes['on_hand'] = (string) $resource['on_hand'];
        $attributes['description'] = (string) $resource['description'];
        $attributes['created_at'] = (string) $resource['created_at'];
        $attributes['updated_at'] = (string) $resource['updated_at'];
        $attributes['deleted_at'] = (string) $resource['deleted_at'];

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
            'stocks' => [
                self::SHOW_SELF => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA => true,
                self::DATA => function () use ($resource) {
                    return $resource->stocks;
                },
            ],
        ];
    }
}
