<?php

namespace App\Controllers;
use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index() {
        $this->view("register", [], "Register");
    }

    public function register() {
        $validation = $this->request()->validate([
            "name"=>["required", "min:3", "max:255"],
            "email"=> ["required", "min:8", "email"],
            "password"=> ["required", "min:8", "max:255", "confirmed"],
            "password_confirmation"=> ["required", "min:8", "max:255"]
        ]);

        if (!$validation) {
            foreach($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }
            $this->redirect('/register');
        } 

        $name = $this->request()->input('name');
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

        $this->db()->insert('users', [
            'name'=> $name,
            'email'=> $email,
            'password'=> password_hash($password, PASSWORD_DEFAULT)
        ]);

        $this->auth()->attempt($email, $password);
        $this->redirect('/');
    }
}