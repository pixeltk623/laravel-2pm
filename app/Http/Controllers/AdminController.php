<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }


    public function auth(Request $request) {

        $username = $request->post('username');
        $password = $request->post('password');

        $result = Admin::where('username', $username)->first();

        if ($result) {
                
                if(Hash::check($password,$result->password)) {
                    $request->session()->put('Is_Login', true);
                    $request->session()->put('user_id', $result->id);
                    return redirect('dashboard');

                } else {
                    $request->session()->flash('error','Password is Wrong');
                    return redirect('/admin');
                }

        } else {

            $request->session()->flash('error','UserName is Not Valid');
            return redirect('/admin');
        }

        // echo "<pre>";

        // print_r($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function updatePassword() {

        $admin = Admin::find(1);
        $admin->password = Hash::make("123");
        $admin->save();

        echo "<pre>";
        print_r($admin);
    }
}
