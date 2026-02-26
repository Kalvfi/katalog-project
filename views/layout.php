<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Katalog produktů</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; margin: 0; min-height: 100vh; }
        .sidebar { width: 250px; background: #f4f4f4; padding: 20px; border-right: 1px solid #ddd; }
        .content { padding: 40px; flex: 1; }
        ul { list-style-type: none; padding-left: 20px; }
        .sidebar > ul { padding-left: 0; }
        .sidebar a { text-decoration: none; color: #333; }
        .sidebar a:hover { text-decoration: underline; }
        .product-card { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .product-card a { text-decoration: none; color: #0056b3; font-weight: bold; font-size: 1.2em; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Kategorie</h3>
        <?php
        function buildMenu($categories, $parentId = null) {
            $html = '<ul>';
            $hasChildren = false;
            foreach ($categories as $cat) {
                if ($cat->parent_id == $parentId) {
                    $hasChildren = true;
                    $html .= '<li><a href="index.php?controller=catalog&action=category&id='.$cat->id.'">' . htmlspecialchars($cat->name) . '</a>';
                    $html .= buildMenu($categories, $cat->id);
                    $html .= '</li>';
                }
            }
            $html .= '</ul>';
            return $hasChildren ? $html : '';
        }
        
        if (isset($categories)) echo buildMenu($categories);
        ?>
        <hr>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?controller=admin&action=index" style="display:block; margin-bottom: 10px;">⚙️ Administrace</a>
            <a href="index.php?controller=auth&action=logout" style="color: #dc3545;">🚪 Odhlásit se</a>
        <?php else: ?>
            <a href="index.php?controller=auth&action=login">🔒 Přihlášení (Admin)</a>
        <?php endif; ?>
    </div>

    <div class="content">
        <?php 
        if (isset($viewContent)) {
            require $viewContent;
        } else {
            echo "<h1>Vítejte v našem katalogu</h1><p>Vyberte kategorii z menu vlevo.</p>";
        } 
        ?>
    </div>
</body>
</html>