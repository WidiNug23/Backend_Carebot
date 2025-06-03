<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Kuesioner FSQ
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Kuesioner FSQ</h1>

<form action="<?= site_url('kuesioner/nilai') ?>" method="post">
    <ul>
        <?php foreach ($kuesioner as $item): ?>
            <li>
                <label>
                    <input type="radio" name="pernyataan[<?= $item['id_fsq'] ?>]" value="<?= $item['id_fsq'] ?>" required>
                    <?= $item['pernyataan'] ?>
                </label>
            </li>
        <?php endforeach; ?>
    </ul>

    <button type="submit">Kirim Jawaban</button>
</form>

<a href="<?= site_url('kuesioner') ?>">Kembali ke Daftar Kuesioner</a>
<?= $this->endSection() ?>
