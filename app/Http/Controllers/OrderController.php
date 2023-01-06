<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductOrdersResource;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrders;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepositorie)
    {
        $this->orderRepository = $orderRepositorie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->orderRepository->allOrders();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth('sanctum')->user();
        $order = Order::query()->create([
            'user_name' => auth()->user()->first_name,
            'user_phone' => '+992987722178',
            'total_price' => $request->total_price,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        $products = [];
        foreach ($request->products as $product) {
            $products[] = [
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        $product_order = ProductOrders::query()->insert($products);

        return response()->json($product_order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show($id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $order = $this->orderRepository->getOrder($id);
        return ProductOrdersResource::collection($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $this->orderRepository->updateOrder($id, $request->all());

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->orderRepository->deleteOrder($id);

        return response()->json(['message' => 'Order deleted'], 200);
    }

    public function buyproduct(Request $request, $hash)
    {
        $product = Product::query()->where('id_hash', $hash)->first();

        if ($hash == md5('basket')) {
            $amount = 0;
            $baskets = Basket::query()->where('user_id', auth('sanctum')->id())->get();
            foreach ($baskets as $basket) {
                $amounts = $basket->price * $basket->quantity;
                $amount += $amounts;
            }

            return response()->json(['data' => $baskets, 'amount' => $amount]);
        } elseif ($product) {
            return response()->json([
                'data' => [
                    ['product_id' => $product->id,
                        'user_id' => auth('sanctum')->id(),
                        'product_name' => $product->name,
                        'product_image' => $product->image->path,
                        'quantity' => $request->quantity,
                        'price' => $product->price, ],
                ],
                'amount' => $product->price,
            ]);
        }

        return response()->json(['message' => 'Not found']);
    }

    public function myorders(): \Illuminate\Http\JsonResponse
    {
        $orders = Order::query()->where('user_id', auth('sanctum')->id())->get();

        return response()->json($orders);
    }
}
