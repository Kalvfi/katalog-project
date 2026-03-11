<?php
class AdminController {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public function index() {
        $categories = Category::getAll();
        
        $products = Product::getAllWithCategories();

        $viewContent = 'views/admin.php';
        require 'views/layout.php';
    }

    // -------< Product >-------
    public function productForm() {
        $categories = Category::getAll();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        $product = $id ? Product::getById($id) : null;
        
        $viewContent = 'views/product_form.php';
        require 'views/layout.php';
    }

    public function saveProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            if ($id) {
                Product::update($id, $name, $description, $price, $category_id);
            } else {
                Product::create($name, $description, $price, $category_id);
            }
        }
        header('Location: index.php?controller=admin&action=index');
        exit;
    }

    public function deleteProduct() {
        if (isset($_GET['id'])) {
            Product::delete((int)$_GET['id']);
        }
        header('Location: index.php?controller=admin&action=index');
        exit;
    }

    // -------< Category >-------
    public function saveCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Category::create($_POST['name'], $_POST['parent_id']);
        }
        header('Location: index.php?controller=admin&action=index');
        exit;
    }

    public function deleteCategory() {
        if (isset($_GET['id'])) {
            $categoryId = (int)$_GET['id'];
            $categories = Category::getAll();
            
            $ids = Category::getDescendantIds($categories, $categoryId);
            
            $products = Product::getByCategories($ids);
            
            if (count($products) > 0) {
                $_SESSION['admin_error'] = "Chyba: Kategorii nelze smazat, protože ona nebo její podkategorie stále obsahují produkty.";
            } else {
                foreach($ids as $id){
                    Category::delete($id);
                }
                $_SESSION['admin_success'] = "Kategorie byla úspěšně smazána.";
            }
        }
        header('Location: index.php?controller=admin&action=index');
        exit;
    }
}