<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock > 0 ? $this->stock : 'Out of stock',
            'discount' => $this->discount,
            'totalPrice' => round($this->price - ($this->price * ($this->discount / 100))),
            'rating' => $this->reviews->sum('star') > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'not rating yet',
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
