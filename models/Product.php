<?php
class Product {
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $created_at;

    public static function getByCategories($categoryIds, $sortBy = 'name') {
        if (empty($categoryIds)) return [];

        $db = Database::getConnection();
        
        $allowedSorts = ['name', 'price_asc', 'price_desc'];
        if (!in_array($sortBy, $allowedSorts)) $sortBy = 'name';
        
        $orderBy = "name ASC";
        if ($sortBy === 'price_asc') $orderBy = "price ASC";
        if ($sortBy === 'price_desc') $orderBy = "price DESC";

        $placeholders = str_repeat('?,', count($categoryIds) - 1) . '?';

        $stmt = $db->prepare("SELECT * FROM products WHERE category_id IN ($placeholders) ORDER BY $orderBy");
        $stmt->execute($categoryIds);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
        return $stmt->fetch();
    }

    // >------- Admin -------<
    public static function create($name, $description, $price, $category_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO products (name, description, price, category_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $price, $category_id]);
    }

    public static function update($id, $name, $description, $price, $category_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE products SET name = ?, description = ?, price = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $price, $category_id, $id]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}