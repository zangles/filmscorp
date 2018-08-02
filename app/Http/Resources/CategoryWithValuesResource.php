<?php

namespace App\Http\Resources;

use App\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryWithValuesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'name' => $this->name,
            'properties' => CategoryPropertyWithValuesResource::collection($this->property)->additional(['product_id' => '99'])
        );
    }
}
