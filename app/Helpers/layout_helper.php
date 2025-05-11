<?php

if (!function_exists('include_sidebar')) {
    function include_sidebar()
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->to('/login');
        }

        $roles = $user->getGroups();
        $role = $roles[0] ?? 'user';

        if ($role === 'admin') {
            echo view('layouts/components/sidebar_admin');
        } else {
            echo view('layouts/components/sidebar_user');
        }
    }
}
