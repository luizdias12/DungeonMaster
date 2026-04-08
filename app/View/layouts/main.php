<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dungeon Master' ?></title>

    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body>

    <?php require basePath('app/View/partials/header.php'); ?>
    <?php require basePath('app/View/partials/navbar.php'); ?>

    <main class="container">
        <?= $content ?>
    </main>

    <?php require basePath('app/View/partials/footer.php'); ?>
    <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>