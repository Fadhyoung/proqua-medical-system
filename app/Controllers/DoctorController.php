<?php

namespace App\Controllers;

class DoctorController extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view(string $page = 'home')
    {
        // ...
    }
}
