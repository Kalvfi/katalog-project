<h2>Přihlášení do administrace</h2>

<?php if (!empty($error)): ?>
    <div style="background: #ffcccc; color: #cc0000; padding: 10px; margin-bottom: 15px; border: 1px solid #cc0000; border-radius: 4px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?controller=auth&action=login" style="max-width: 300px; background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Uživatelské jméno:</label>
        <input type="text" name="username" required style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Heslo:</label>
        <input type="password" name="password" required style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>
    <button type="submit" style="width: 100%; padding: 10px; background: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Přihlásit se
    </button>
</form>