<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Redirect;
use Stripe;


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

    public function sendPayemnt(Request $request) {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "inr",
                "source" => $request->post('tokenId'),
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }


    public function createToken(Request $request) {

        $stripe = new \Stripe\StripeClient('sk_test_4NBbDxxVc50ogIZOEARYRKNP00AnsXYzDi');

        $token = $stripe->tokens->create([
          'card' => [
            'number' => '4242424242424242',
            'exp_month' => 8,
            'exp_year' => 2022,
            'cvc' => '314',
          ],
        ]);

        return json_encode($token['id']);

        //$this->sendPayemnt($token->id);
        // echo "<pre>";

        // print_r($token);
    }

}
