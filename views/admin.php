<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Správa katalogu</h2>
    <a href="index.php?controller=auth&action=logout" style="padding: 8px 15px; background: #dc3545; color: white; text-decoration: none; border-radius: 4px;">Odhlásit se (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
</div>

<?php if (isset($_SESSION['admin_error'])): ?>
    <div style="background: #ffcccc; color: #cc0000; padding: 15px; margin-bottom: 20px; border: 1px solid #cc0000; border-radius: 4px; font-weight: bold;">
        ⚠️ <?= htmlspecialchars($_SESSION['admin_error']) ?>
    </div>
    <?php unset($_SESSION['admin_error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['admin_success'])): ?>
    <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border: 1px solid #c3e6cb; border-radius: 4px;">
        ✅ <?= htmlspecialchars($_SESSION['admin_success']) ?>
    </div>
    <?php unset($_SESSION['admin_success']); ?>
<?php endif; ?>

<div style="display: flex; gap: 30px;">
    <div style="flex: 2;">
        <h3>Seznam produktů</h3>
        <a href="index.php?controller=admin&action=productForm" style="display: inline-block; margin-bottom: 15px; padding: 8px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 4px;">+ Přidat nový produkt</a>
        
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9em;">
            <thead>
                <tr style="background: #f4f4f4; border-bottom: 2px solid #ddd;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Název</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Kategorie</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Cena</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allProducts as $p): ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px; border: 1px solid #ddd;"><strong><?= htmlspecialchars($p->name) ?></strong></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($p->category_name) ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= number_format($p->price, 0, ',', ' ') ?> Kč</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <a href="index.php?controller=admin&action=productForm&id=<?= $p->id ?>" style="color: #0056b3; text-decoration: none; margin-right: 10px;">Upravit</a>
                            <a href="index.php?controller=admin&action=deleteProduct&id=<?= $p->id ?>" onclick="return confirm('Opravdu smazat produkt?');" style="color: #dc3545; text-decoration: none;">Smazat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div style="flex: 1; background: #f9f9f9; padding: 15px; border-radius: 5px; border: 1px solid #ddd;">
        <h3>Kategorie</h3>
        
        <form method="POST" action="index.php?controller=admin&action=saveCategory" style="margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px; font-weight:bold;">Nová kategorie:</label>
            <input type="text" name="name" required placeholder="Název..." style="width: 100%; padding: 5px; margin-bottom: 10px; box-sizing:border-box;">
            
            <label style="display:block; margin-bottom: 5px; font-weight:bold;">Nadřazená kategorie:</label>
            <select name="parent_id" style="width: 100%; padding: 5px; margin-bottom: 10px; box-sizing:border-box;">
                <option value="">-- Žádná (Hlavní kategorie) --</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c->id ?>"><?= htmlspecialchars($c->name) ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit" style="width: 100%; padding: 8px; background: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer;">Přidat kategorii</button>
        </form>

        <ul style="padding-left: 0; list-style: none;">
            <?php foreach ($categories as $c): ?>
                <li style="margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center;">
                    <span><?= htmlspecialchars($c->name) ?></span>
                    <a href="index.php?controller=admin&action=deleteCategory&id=<?= $c->id ?>" onclick="return confirm('Opravdu smazat kategorii? Smažou se i všechny její podkategorie!');" style="color: #dc3545; text-decoration: none; font-size: 0.9em;">[Smazat]</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>