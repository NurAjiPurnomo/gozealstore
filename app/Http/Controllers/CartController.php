<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Binafy\LaravelCart\Models\Cart;
use Binafy\LaravelCart\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cart;

    public function __construct()
    {
        $this->cart = Cart::query()->firstOrCreate(['user_id' => auth()->guard('customer')->user()->id]);
    }

    public function add(Request $request)
    {
        // Validate the request
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Invalid input data.')
                ->withErrors($validator)
                ->withInput();
        }

        // Find the product
        $product = Product::findOrFail($request->product_id);

        // Check if the product is available
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock for this product.');
        }

        $cartItem = new CartItem([
            'itemable_id' => $product->id,
            'itemable_type' => $product::class,
            'quantity' => $request->quantity,
        ]);

        $this->cart->items()->save($cartItem);

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        $this->cart->removeItem($cartItem);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function update($id, Request $request)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($request->action == 'decrease') {
            $this->cart->decreaseQuantity(item: $cartItem);
        } elseif ($request->action == 'increase') {
            $this->cart->increaseQuantity(item: $cartItem);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }
}
