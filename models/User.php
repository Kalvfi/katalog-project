<?php
class User {
    public $id;
    public $username;
    public $password_hash;
    public $role;

    public static function authenticate($username, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user->password_hash)) {
            return $user;
        }
        return false;
    }
}