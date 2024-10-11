<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index () {
      return view('main.main_menu');
    }

    public function preview_page () {
      return view('main.preview_page');
    }

    public function new_trans () {
      return view('main.new_trans');
    }

    public function saved_trans () {
      return view('main.saved_trans');
    }
}
