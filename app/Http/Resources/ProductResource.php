<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
            'id' => $this->id,
            'name' => Str::limit($this->name, 150),
            'price' => $this->price,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'view' => $this->view,
            'image' => $this->image->path ?? null,
            'created_at' => $this->created_at,
            'category' => $this->category,
            'subcategory_id' => $this->subcategory_id,
            'brand_id' => $this->brand_id,
            'attributes' => AttributeResource::collection($this->getProductAttribute),
        ];
    }
}
