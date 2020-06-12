<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Rol;

use Auth;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Auth::user();        
        if($user){
            return view('home');
        }
    }
    
}
