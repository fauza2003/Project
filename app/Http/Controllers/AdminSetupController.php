<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminSetupController extends Controller
{
    public function createAdmin()
    {
        $user = new User();
        $user->name = 'Admin User';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('password'); // Ganti dengan password yang aman
        $user->is_admin = true;
        $user->save();

        return 'Admin user created successfully';
    }
}