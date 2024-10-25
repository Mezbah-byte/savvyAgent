<?php

namespace App\Controllers;

use App\Models\Auth\AuthModel;


class Auth extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
    }

    public function login()
    {
        // Load the validation service
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);

        // Check if the form validation passes
        if ($validation->withRequest($this->request)->run() === FALSE)
        {
            // If validation fails, reload the form with errors
            return view('auth/login', [
                'validation' => $validation
            ]);
        }

        // If validation passes, check user credentials
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Load the User model to check credentials
        $userModel = new AuthModel();
        $user = $userModel->can_login($email, $password);

        if ($user && $user['status'] == 1 && $user['email'] == $email && $user['password'] == $password)
        {
            // Credentials are correct, set user session
            $session = session();
            $session->set('isLoggedIn', true);
            $session->set('userUnId', $user['un_id']);
            $session->set('name', $user['name']);
            $session->set('email', $user['email']);
            $session->set('phone_number', $user['phone_number']);
            
            return redirect()->to('/dashboard');
        }
        else
        {
            // Invalid credentials, reload the form with error
            return view('auth/login', [
                'validation' => $validation,
                'error' => 'Invalid email or password'
            ]);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
