<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => CustomerResource::make($this->whenLoaded('customer')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'total' => $this->products->sum(function ($product) {
                return $product->pivot->quantity * $product->price;
            }),
            'status' => $this->status,
        ];
    }

    /**
     * Load the relations for the resource collection.
     */
    static public function loadRelations($collection)
    {
        $collection->load(['products', 'customer']);
    }
}
