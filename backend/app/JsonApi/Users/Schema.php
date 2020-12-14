<?php

namespace App\JsonApi\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

    /**
     * @param \App\User $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->id;
    }

    /**
     * @param \App\User $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'email' => $resource->email,
            'currency' => $resource->currency,
            'status' => $resource->status,
            'balance' => $resource->balance,
            'provider' => $resource->provider,
            'createdAt' => $resource->created_at,
        ];
    }
}
