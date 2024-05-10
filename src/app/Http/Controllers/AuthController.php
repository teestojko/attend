<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        // $users = User::Paginate(10);
        // return view('index', compact('users'));
        $username = null;
        if (auth()->check()) {
            $username = auth()->user()->name;
        }

        $users = User::paginate(10);
        return view('index', compact('users', 'username'));
    }
}
