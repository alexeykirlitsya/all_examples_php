<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;

class ProductController extends Controller
{
    public function getIndex(){
        $products = Product::all();
        return view('index')->with('products', $products);
    }

    public function getAddCart(Request $request, $id){
        $product = Product::findOrFail($id);
        $oldCart = Session::has('Cart') ? Session::get('Cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('Cart', $cart);
//        dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }

    public function getCart(){
        if (!Session::has('Cart')){
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('Cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart')->with('products', $cart->items)->with('totalPrice', $cart->totalPrice);
    }

    public function getCheckout(){
        if (!Session::has('Cart')){
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('Cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout')->with('total', $total);
    }
}
