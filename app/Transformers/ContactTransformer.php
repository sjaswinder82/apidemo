<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ContactTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($resource)
    {
        return [
            'id' => $resource->id,
            'created_by' => $resource->user->name,
            'name' => $resource->name,
            'email' => $resource->email,
            'phone' => $resource->phone,
            'image' => $resource->image_url,
            'created_at' => $resource->created_at,
        ];
    }
}
