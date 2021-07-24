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

    public function deleteData(Request $request, $id) {
        //echo $id;

        if($id>0) {
            $blog = Blog::find($id);
            $blog->delete();
            $request->session()->flash('message_d','Blog Deleted');
            return redirect('/');
        }
    }

    public function showData(Request $request, $id) {
        //echo $id;

        if($id>0) {
            $blog['blog'] = Blog::find($id);
            return view('blogs.blog_show', $blog);
        }
    }

    public function editData(Request $request, $id) {
        //echo $id;

        if($id>0) {
            $blog['blog'] = Blog::find($id);
            return view('blogs.blog_edit', $blog);
        }
    }


    public function updateData(Request $request) {

        $blog = Blog::find($request->post('id'));
        $blog->title = $request->post('title');
        $blog->source = $request->post('source');
        $blog->description = $request->post('description');
        $blog->save();
        $request->session()->flash('message','Blog Updated');
        return redirect('/');
    }

    public function manage_form($id=null) {

        if($id>0) {
            $blogs = Blog::find($id);
            $blog['blog'] = array(
                'id' => $blogs['id'],
                'title' => $blogs['title'],
                'source' => $blogs['source'],
                'description' => $blogs['description']

            );
        } else {
            $blog['blog'] = array(
                'id' => 0,
                'title' => '',
                'source' => '',
                'description' => ''

            );
        }

        return view('blogs.manage_form', $blog);
    }

    public function manage_process(Request $request, $id=null) {

        if($request->post('id')>0) {
            $blog = Blog::find($request->post('id'));
            $message =  "Updated";
        } else {
            $blog = new Blog();
            $message =  "Inserted";
        }

        $blog->title = $request->post('title');
        $blog->source = $request->post('source');
        $blog->description = $request->post('description');
        $blog->save();
        $request->session()->flash('message',$message);
        return redirect('/');

    }
}
