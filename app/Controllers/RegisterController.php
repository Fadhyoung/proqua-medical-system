<?php

namespace App\Controllers;

use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class RegisterController extends ShieldRegisterController
{

    public function registerView()
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        // Check if registration is allowed
        if (! setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // If an action has been defined, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show');
        }

        return $this->view(setting('Auth.views')['register']);
    }

    public function registerAction(): RedirectResponse
    {

        $response = parent::registerAction();
        $user = auth()->user();        

        if ($user) {
            $request = service('request');
            $email = $request->getPost('email');

            if (str_ends_with($email, '@example.com')) {
                $user->syncGroups('admin');
            } else {
                $user->syncGroups('user');
            }
        }

        return $response;
    }
}
