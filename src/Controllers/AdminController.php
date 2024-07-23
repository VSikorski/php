<?php

namespace App\Controllers;
use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;

class AdminController extends Controller 
{
    private $categories = [];

    public function index(): void 
    {
        $categoryService = new CategoryService($this->db());
        $movieService = new MovieService($this->db());
        
        $this->view('admin/index', [
            'categories'=> $categoryService->all(),
            'movies' => $movieService->all(),
        ], "Admin");
    }

    public function getCategories(): array {
        return $this->categories;
    }
    
}