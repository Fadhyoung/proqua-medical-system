<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect()->to('/login');
    }
}
