<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kuesioner</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <h1>Daftar Kuesioner</h1>

    <ul>
        <?php foreach ($jenis as $item): ?>
            <li><a href="<?= site_url('kuesioner/tampilkan/' . $item) ?>"><?= $item ?></a></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
