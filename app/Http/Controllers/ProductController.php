<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Redirect;

class ProductController extends Controller
{
    
    public function index() {



    	$data['data'] = Product::all();

    	// echo "<pre>";
    	// print_r($data);

     //    die;

    	return view('products', $data);
    }

    public function addToCart(Request $request, $id) {

    	//echo $id;

        // session()->forget('cart');

    	$products = Product::findOrFail($id);

    	// echo "<pre>";

    	// print_r($products);
     //    die;

    	$cart = session()->get('cart', []);

    	// echo "<pre>";

    	// print_r($cart);
    	// die;

    	if (isset($cart[$id])) {
    		$cart[$id]['quantity']++;
    	} else {
    		$cart[$id] = [
    			"name" => $products->name,
    			"quantity" => 1,
    			"price" => $products->price,
    			"image" => $products->image,
    		];
    	}
    	session()->put('cart', $cart);

		$request->session()->flash('msg','Product Added in Cart');
    	return redirect('/product');
    }

    public function checkout() {

       return view("checkout");
    }


    public function update(Request $request) {

        if ($request->post('pid') && $request->post('qty')) {
           $cart = session()->get('cart');
           $cart[$request->post('pid')]['quantity'] = $request->post('qty');
           session()->put('cart', $cart);
           $request->session()->flash('msg','Product Updated in Cart');
           //return redirect('/Checkout');

        }

    }

    public function delete(Request $request, $id) {

        if ($request->id) {
            $cart = session()->get('cart');

            
            // die;
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);

            }
            // echo "<pre>";

            // print_r($cart);
            // die;

            $cart = session()->put('cart', $cart );
        }

        $request->session()->flash('msg','Product Removed from Cart');
        return redirect('/Checkout');
    }

}
