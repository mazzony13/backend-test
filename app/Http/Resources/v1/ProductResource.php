<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'image' => $this->getFirstMediaUrl('product-image'),
            'is_active' => $this->is_active,
            //check user type if admin show all prices else show only premitted price to user depends on his role
            'price'=>auth()->user()->hasRole('super-admin') ? $this->price : $this->price[auth()->user()->type]
        ];
    }
}
