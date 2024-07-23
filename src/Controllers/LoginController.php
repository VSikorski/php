<?php

namespace App\Controllers;
use App\Kernel\Controller\Controller;

class LoginController extends Controller {
    public function index(): void {
        $this->view("login", [], "Login");
    }

    public function login(): void {
        $validation = $this->request()->validate([
            "email"=> ["required", "min:8", "email"],
            "password"=> ["required", "min:8", "max:255"]
        ]);

        if (!$validation) {
            foreach($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }
            $this->redirect('/login');
        } 


        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

        if ($this->auth()->attempt($email, $password)) {
            $this->redirect('/home');
        }

        $this->session()->set('error', 'Wrong credentials');
        $this->redirect('/login');
    }

    public function logout(): void {   
        $this->auth()->logout();
        $this->redirect('/home');
    }
}