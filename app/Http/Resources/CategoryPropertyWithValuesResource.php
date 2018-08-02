<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryPropertyWithValuesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = Product::find($this->pivot->product_id);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $product->property()->wherePivot('category_property_id', $this->id)->get()->first()->pivot->value
        ];
    }
}
