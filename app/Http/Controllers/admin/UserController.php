<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->select(['id', 'name', 'email'])->paginate();

        return view('admin.users.list')->with('users', $users);
    }
}