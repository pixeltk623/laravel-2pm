<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $products = [
        	[
        		"name" => "FOXTER",
        		"description" => "Black and White Pack of 2 Stainless Steel Stylish Girls Combo pack of 2 New Arrival Stylish Attractive Ethnic Stylish Bracelet Look Analog Watch for Girls Analog Watch Analog Watch Analog Watch - For Girls",
        		"image" => "https://rukminim1.flixcart.com/image/800/960/kffq2kw0-0/watch/s/3/b/black-and-white-pack-of-2-stainless-steel-foxter-original-imafvwafxdavgx9g.jpeg?q=50",
        		"price" => 439
        	],
        	[
        		"name" => "T-Shirt",
        		"description" => "Black and White Pack of 2 Stainless Steel Stylish Girls Combo pack of 2 New Arrival Stylish Attractive Ethnic Stylish Bracelet Look Analog Watch for Girls Analog Watch Analog Watch Analog Watch - For Girls",
        		"image" => "https://rukminim1.flixcart.com/image/800/960/kd7pevk0/t-shirt/j/m/x/m-41572-wildcraft-original-imafu674s9dh2hvk.jpeg?q=50",
        		"price" => 639
        	],
        	[
        		"name" => "Black T-Shirt",
        		"description" => "Black and White Pack of 2 Stainless Steel Stylish Girls Combo pack of 2 New Arrival Stylish Attractive Ethnic Stylish Bracelet Look Analog Watch for Girls Analog Watch Analog Watch Analog Watch - For Girls",
        		"image" => "https://rukminim1.flixcart.com/image/800/960/khmbafk0-0/t-shirt/w/j/s/xs-t322-blwh-seven-rocks-original-imafxhagtyj2xvpn.jpeg?q=50",
        		"price" => 939
        	],
        	[
        		"name" => "Shirt",
        		"description" => "Black and White Pack of 2 Stainless Steel Stylish Girls Combo pack of 2 New Arrival Stylish Attractive Ethnic Stylish Bracelet Look Analog Watch for Girls Analog Watch Analog Watch Analog Watch - For Girls",
        		"image" => "https://rukminim1.flixcart.com/image/800/960/kljrvrk0/t-shirt/q/r/0/l-trdhdful-d32-tripr-original-imagynnpg2fh62ht.jpeg?q=50",
        		"price" => 1439
        	],
        ];


        foreach ($products as $key => $value) {
        	Product::create($value);
        }

    }
}
