<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        $pageConfigs = [
            'myLayout' => 'blank'
          ];
    
          return view('auth.login', [
            'pageConfigs' => $pageConfigs,
          ]);
    }

    // public function login() {
    // //     return
    // // }
}