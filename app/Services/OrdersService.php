<?php

namespace App\Services;

use App\Models\ProductOrders;

class OrdersService
{
    public static function createProductOrders($order, $product)
    {
        $product_order = ProductOrders::query()->where('order_id', $order->id)->where('product_id', $product->id)->first();
        if ($product_order) {
            $product_order->increment('quantity');
        } else {
            $product_order = ProductOrders::query()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return $product_order;
    }
}
