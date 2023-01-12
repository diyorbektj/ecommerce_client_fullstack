<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $basket = Basket::query()
            ->where('guid', \request()->guid)
            ->where('product_id', $request->id)
            ->first();
        if ($basket) {
            $basket->increment('quantity');
        } else {
            $product = Product::with('image')->find($request->id);
            $basket = Basket::query()->create([
                'product_id' => $product->id,
                'user_id' => auth('sanctum')->id() ?? null,
                'product_name' => $product->name,
                'product_image' => $product->image->path,
                'quantity' => 1,
                'price' => $product->price,
                'guid' => $request->guid
            ]);
        }

        return response()->json($basket);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Basket $basket)
    {
        return response()->json($basket->where('guid', \request()->guid)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Basket::query()->findOrFail($request->id)->delete();

        return $data;
    }

    public function decrement(Request $request)
    {
        $basket = Basket::query()->findOrFail($request->id)->decrement('quantity');

        return response()->json($basket);
    }

    public function clear_product()
    {
        $basket = Basket::query()->where('user_id', auth('sanctum')->id())->delete();

        return response()->json(['message' => 'Deleted!!']);
    }
}
