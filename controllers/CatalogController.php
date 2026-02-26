<?php
class CatalogController {
    public function index() {
        $categories = Category::getAll();
        require 'views/layout.php'; 
    }

    public function category() {
        $categories = Category::getAll();
        $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name';
        
        $currentCategory = Category::getById($categoryId);
        
        $categoryIdsToFetch = Category::getDescendantIds($categories, $categoryId);
        
        $products = Product::getByCategories($categoryIdsToFetch, $sortBy);

        $viewContent = 'views/category.php';
        require 'views/layout.php';
    }

    public function product() {
        $categories = Category::getAll();
        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        $product = Product::getById($productId);

        $viewContent = 'views/product.php';
        require 'views/layout.php';
    }
}