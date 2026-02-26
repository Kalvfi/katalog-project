<h2><?= $product ? 'Upravit produkt' : 'Přidat nový produkt' ?></h2>

<form method="POST" action="index.php?controller=admin&action=saveProduct" style="max-width: 500px; background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    
    <input type="hidden" name="id" value="<?= $product ? $product->id : 0 ?>">

    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Název:</label>
        <input type="text" name="name" value="<?= $product ? htmlspecialchars($product->name) : '' ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Kategorie:</label>
        <select name="category_id" required style="width: 100%; padding: 8px; box-sizing: border-box;">
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c->id ?>" <?= ($product && $product->category_id == $c->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Cena (Kč):</label>
        <input type="number" name="price" value="<?= $product ? $product->price : '' ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Popis:</label>
        <textarea name="description" rows="5" required style="width: 100%; padding: 8px; box-sizing: border-box;"><?= $product ? htmlspecialchars($product->description) : '' ?></textarea>
    </div>

    <div style="display: flex; gap: 10px;">
        <button type="submit" style="padding: 10px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Uložit produkt
        </button>
        <a href="index.php?controller=admin&action=index" style="padding: 10px 15px; background: #ccc; color: #333; text-decoration: none; border-radius: 4px;">Zrušit</a>
    </div>
</form>