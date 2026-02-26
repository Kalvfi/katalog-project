<?php if ($currentCategory): ?>
    <h2>Produkty v kategorii: <?= htmlspecialchars($currentCategory->name) ?></h2>
    
    <form method="GET" action="index.php" style="margin-bottom: 20px;">
        <input type="hidden" name="controller" value="catalog">
        <input type="hidden" name="action" value="category">
        <input type="hidden" name="id" value="<?= $currentCategory->id ?>">
        <label>Seřadit podle:</label>
        <select name="sort" onchange="this.form.submit()">
            <option value="name" <?= $sortBy == 'name' ? 'selected' : '' ?>>Názvu</option>
            <option value="price_asc" <?= $sortBy == 'price_asc' ? 'selected' : '' ?>>Ceny (od nejnižší)</option>
            <option value="price_desc" <?= $sortBy == 'price_desc' ? 'selected' : '' ?>>Ceny (od nejvyšší)</option>
        </select>
    </form>

    <?php if (empty($products)): ?>
        <p>Žádné produkty v této kategorii.</p>
    <?php else: ?>
        <?php foreach ($products as $p): ?>
            <div class="product-card">
                <h3><a href="index.php?controller=catalog&action=product&id=<?= $p->id ?>"><?= htmlspecialchars($p->name) ?></a></h3>
                <p>Cena: <strong><?= number_format($p->price, 0, ',', ' ') ?> Kč</strong></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else: ?>
    <h2>Kategorie nenalezena.</h2>
<?php endif; ?>