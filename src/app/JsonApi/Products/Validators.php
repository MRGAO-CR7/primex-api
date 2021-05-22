<?php

namespace App\JsonApi\Products;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = [
        'stocks'
    ];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = [
        'on_hand',
    ];

    /**
     * The filters a client is allowed send.
     *
     * @var string[]|null
     *      the allowed filters, an empty array for none allowed, or null to allow all.
     */
    protected $allowedFilteringParameters = [
        'withTrashed',
        'onlyTrashed',
        'quantity',
        'operator',
    ];

    /**
     * Get resource validation rules.
     *
     * @param mixed|null $record
     *      the record being updated, or null if creating a resource.
     * @param array $data
     *      the data being validated
     * @return array
     */
    protected function rules($record, array $data): array
    {
        $rules = [
            'code' => 'required|string|between:1,45',
            'name' => 'required|string|between:1,45',
            'description' => 'required|string|between:1,100',
            'on_hand' => 'disallowed_parameter',
            'created_at' => 'disallowed_parameter',
            'updated_at' => 'disallowed_parameter',
            'deleted_at' => 'disallowed_parameter',
        ];

        return $record ? [] : $rules;
    }

    /**
     * Get query parameter validation rules.
     *
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            //
        ];
    }

}
