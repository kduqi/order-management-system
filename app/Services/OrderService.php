<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create([
                'customer_id' => $data['customer_id'],
                'status' => 'processing',
            ]);

            foreach ($data['products'] as $productData) {
                $product = Product::where('id', $productData['id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                // Check stock
                if ($product->stock < $productData['quantity']) {
                    throw new Exception("Not enough stock for product: {$product->name}");
                }

                // Decrease stock
                $product->decrement('stock_quantity', $productData['quantity']);

                // Attach product to order
                $order->products()->attach($product->id, [
                    'quantity' => $productData['quantity'],
                ]);
            }

            return $order->load('products');
        });
    }

    public function delete(Order $order)
    {
        DB::transaction(function () use ($order) {
            $order->products()->detach();

            $order->delete();
        });
    }
}
