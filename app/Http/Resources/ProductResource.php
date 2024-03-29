<?php

namespace App\Http\Resources;

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
        // return parent::toArray($request);

        return [
            "title"=>$this->title,
            "description"=>$this->description,
            "price"=>$this->price,
            "quantity"=>$this->quantity,
            "image"=>asset('storage') . "/" . $this->image ,
            "category_id"=>$this->category_id,
        ];
    }
}
