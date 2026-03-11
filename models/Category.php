<?php
class Category {
    public $id;
    public $name;
    public $parent_id;

    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Category');
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
        return $stmt->fetch();
    }

    public static function getDescendantIds($allCategories, $parentId) {
        $ids = [$parentId];
        foreach ($allCategories as $cat) {
            if ($cat->parent_id == $parentId) {
                $ids = array_merge($ids, self::getDescendantIds($allCategories, $cat->id));
            }
        }
        return $ids;
    }

    // -------< Admin >-------
    public static function create($name, $parent_id) {
        $db = Database::getConnection();
        $parent_id = empty($parent_id) ? null : $parent_id;
        $stmt = $db->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
        return $stmt->execute([$name, $parent_id]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}