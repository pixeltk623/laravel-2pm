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

}
