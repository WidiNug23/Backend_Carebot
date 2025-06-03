<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kuesioner - <?= $jenis ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <h1>Detail Kuesioner: <?= $jenis ?></h1>

    <ul>
        <?php foreach ($kuesioner as $item): ?>
            <li><?= $item['pernyataan'] ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="<?= site_url('kuesioner') ?>">Kembali ke Daftar Kuesioner</a>

</body>
</html>
