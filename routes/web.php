<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function() {

	return view('welcome');
});

Route::get('/blog1',function() {
	//echo "Call Method";
	return view('blog', ['listOfName'=>array(
		"name" => "Sharvan",
		"email" => "9835401515" 
	)
]

);
});

Route::get('/blogs', function() {

	$data['data'] = array("name"=>"sharvan");
	// return view('blogs.blog');
	return view('blogs/blog', $data);
});

Route::get('/list', function() {

	$data['data'] = array("name"=>"sharvan");
	// return view('blogs.blog');
	return view('blogs/list');
});



Route::get('/test/api',function() {
	
	$data['result'] = array("sharvan");

	// echo "<pre>";
	// print_r($data);
	// die;

	return view('blogs/blog',$data);
});

Route::get('/admin', function() {
	return view('admin.dashboard');
});

Route::get('/blog', [BlogController::class, 'index']);