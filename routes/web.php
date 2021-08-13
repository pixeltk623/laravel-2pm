<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

use App\Http\Middleware\AdminAuth;

use App\Http\Controllers\ProductController;




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


// Route::get('/', function() {

// 	return view('welcome');
// });

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

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/update-password', [AdminController::class, 'updatePassword']);

Route::post('/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin_auth');

Route::group(['middleware'=>'admin_auth'], function() {
	Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::get('/logout',function() {
		session()->forget('Is_Login');
        session()->forget('user_id');
        session()->flash('error', 'You are Logout Now');
       	return redirect('admin');
	});

// Route::group(['middleware'=>'admin_auth'], function()
// {
// 	Route::get('/dashboard', [DashboardController::class, 'index']);
// });
Route::get('/', [BlogController::class, 'index']);
Route::get('/create', [BlogController::class, 'loadCreatePage']);
//Route::post('/create', [BlogController::class, 'postFormData']);

Route::post('/postdata', [BlogController::class, 'postDataForm'])->name('create.postdata');
Route::get('/delete/{id}', [BlogController::class, 'deleteData']);
Route::get('/show/{id}', [BlogController::class, 'showData']);
Route::get('/edit/{id}', [BlogController::class, 'editData']);
Route::post('/update', [BlogController::class, 'updateData'])->name('create.update');

Route::post('/deleteFormData', [BlogController::class, 'deleteDataForm'])->name('deleteFormData');


/* ---------------------------------------*/


Route::get('manage_form', [BlogController::class, 'manage_form']);
Route::get('manage_form/{id}', [BlogController::class, 'manage_form']);
Route::post('manage_process', [BlogController::class, 'manage_process'])->name('manage_process');

Route::get('/product', [ProductController::class, 'index']);

Route::get('/addToCart/{id}', [ProductController::class, 'addToCart']);