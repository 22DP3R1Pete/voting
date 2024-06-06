<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class Admin extends Controller 
{
    public static function checkRole(Request $request): bool
    {
        return $request->user() && $request->user()->role === 'admin';
    }
}