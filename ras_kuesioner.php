<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner RAS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <h1>Kuesioner RAS</h1>

    <form action="<?= site_url('kuesioner/nilai') ?>" method="post">
        <ul>
            <?php foreach ($kuesioner as $item): ?>
                <li>
                    <label>
                        <input type="radio" name="pernyataan[<?= $item['id_ras'] ?>]" value="<?= $item['id_ras'] ?>" required>
                        <?= $item['pernyataan'] ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>

        <button type="submit">Kirim Jawaban</button>
    </form>

    <a href="<?= site_url('kuesioner') ?>">Kembali ke Daftar Kuesioner</a>
</body>
</html>
