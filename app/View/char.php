<link rel="stylesheet" href="<?= asset('css/char.css') ?>">

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
            <li>
                <span><?= htmlspecialchars($atributo) ?></span>
                <strong><?= htmlspecialchars((string) $valor) ?></strong>
            </li>
        <?php endforeach; ?>
    </ul>
</section>