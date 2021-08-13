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

    	return view('products', $data);
    }

    public function addToCart(Request $request, $id) {

    	//echo $id;

    	$products = Product::findOrFail($id);

    	// echo "<pre>";

    	// print_r($products);

    	$cart = session()->get('cart', []);

    	// echo "<pre>";

    	// print_r($cart);
    	//die;

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

}
