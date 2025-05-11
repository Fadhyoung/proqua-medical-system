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

    public function deleteUser()
    {
        $users = auth()->getProvider();

        $user = auth()->user();

        $users->delete($user->id, true);

        return redirect()->to('/login');
    }
}
