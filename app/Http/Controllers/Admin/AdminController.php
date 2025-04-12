<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Home
    public function adminHome() {
        return view('admin.main.home');
    }
}
