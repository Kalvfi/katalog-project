<?php if ($product): ?>
    <h2><?= htmlspecialchars($product->name) ?></h2>
    <p style="font-size: 1.2em;"><strong>Cena:</strong> <?= number_format($product->price, 0, ',', ' ') ?> Kč</p>
    <div style="margin-top: 20px; background: #f9f9f9; padding: 15px; border-left: 4px solid #ccc;">
        <p><strong>Popis produktu:</strong></p>
        <p><?= nl2br(htmlspecialchars($product->description)) ?></p>
    </div>
    <br>
    <a href="javascript:history.back()" style="padding: 8px 15px; background: #eee; text-decoration: none; color: #333; border-radius: 4px;">&larr; Zpět na výpis</a>
<?php else: ?>
    <h2>Produkt nenalezen.</h2>
<?php endif; ?>