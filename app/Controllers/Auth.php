<?php

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    public function register()
    {
        if ($this->request->is('post')) {
            $rules = [
                'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]',
            ];
            if ($this->validate($rules)) {
                $userModel = new User();
                $userModel->save([
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
            } else {
                return view('auth/register', ['validation' => $this->validator]);
            }
        }
        return view('auth/register');
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
            ];
            if ($this->validate($rules)) {
                $userModel = new User();
                $user = $userModel->where('email', $this->request->getPost('email'))->first();
                if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                    session()->set([
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'isLoggedIn' => true,
                    ]);
                    return redirect()->to('/tasks');
                } else {
                    return redirect()->back()->with('error', 'Invalid email or password.');
                }
            } else {
                return view('auth/login', ['validation' => $this->validator]);
            }
        }
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully.');
    }
}
