<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    
    public function index() {

    	$blog['blog'] = Blog::all();

    	return view('blogs.blog', $blog);
    }

    public function loadCreatePage() {
    	return view('blogs.create');
    }


    public function postFormData() {
    	echo "<pre>";

    	print_r($_POST);
    }

    public function postDataForm(Request $request) {

    	$validated = $request->validate([
        	'title' => 'required',
        	'source' => 'required',
        	'description' => 'required'
    	]);

    	$blog = new Blog();
    	$blog->title = $request->post('title');
    	$blog->source = $request->post('source');
    	$blog->description = $request->post('description');
    	$blog->save();
    	$request->session()->flash('message','Blog Created');
    	return redirect('/');

    	// die;
    	// echo "<pre>";

    	// print_r($request->all());

    	// echo $request->post('title');
    }
}
