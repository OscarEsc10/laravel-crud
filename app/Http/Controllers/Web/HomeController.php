<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    //
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
}
