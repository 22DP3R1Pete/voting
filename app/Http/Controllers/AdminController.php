<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Admin;

class AdminController extends Controller
{

    public function index()
    {
        $admins = User::where('role', 'admin')->get(); 
        return view('admin.index', ['admins' => $admins]);
    }


}
