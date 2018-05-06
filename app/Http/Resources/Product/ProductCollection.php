<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'discount' => $this->discount,
            'totalPrice' => round($this->price - ($this->price * ($this->discount / 100))),
            'rating' => $this->reviews->sum('star') > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'not rating yet',
            'href' => [
                'link' => route('products.show', $this->id)
                ]
        ];
    }
}
