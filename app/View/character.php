<section class="card">
    <h2><?= htmlspecialchars($character['nome']) ?> <?= htmlspecialchars($character['nome_familia']) ?></h2>

    <div class="grid">
        <div><strong>Gênero:</strong> <?= htmlspecialchars($character['genero']) ?></div>
        <div><strong>Raça:</strong> <?= htmlspecialchars($character['raça']) ?></div>
        <div><strong>Sub-raça:</strong> <?= htmlspecialchars($character['subraça']) ?></div>
        <div><strong>Classe:</strong> <?= htmlspecialchars($character['classe']) ?></div>
        <div><strong>Categoria:</strong> <?= htmlspecialchars($character['categoria']) ?></div>
        <div><strong>Chance:</strong> <?= htmlspecialchars((string) $character['perc']) ?>%</div>
    </div>

    <h3>Atributos</h3>

    <ul class="attributes">
        <?php foreach ($character['atributos'] as $atributo => $valor): ?>
            <?php
                $max = 20;
                $percent = max(0, min(100, ($valor / $max) * 100));

                $classBar = 'fill-low';
                if ($valor >= 15) {
                    $classBar = 'fill-high';
                } elseif ($valor >= 10) {
                    $classBar = 'fill-mid';
                }
            ?>
            <li>
                <div class="attr-top">
                    <span class="attr-name"><?= htmlspecialchars($atributo) ?></span>
                    <strong class="attr-value"><?= htmlspecialchars((string) $valor) ?></strong>
                </div>

                <div class="attr-bar">
                    <div class="attr-fill <?= $classBar ?>" data-width="<?= $percent ?>"></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>