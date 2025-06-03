<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Kuesioner BDI-II
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Kuesioner BDI-II</h1>
<h2><?= $kategori ?></h2>

<form action="<?= site_url('kuesioner/nilai') ?>" method="post">
    <ul>
        <?php foreach ($kuesioner as $item): ?>
            <li>
                <label>
                    <input type="radio" name="pernyataan[<?= $item['id_bdi'] ?>]" value="<?= $item['id_bdi'] ?>" required>
                    <?= $item['pernyataan'] ?>
                </label>
            </li>
        <?php endforeach; ?>
    </ul>

    <div>
        <?php if ($start > 1): ?>
            <a href="<?= site_url('bdi/tampilkan/' . ($start - 4)) ?>">Previous</a>
        <?php endif; ?>

        <?php if (count($kuesioner) == 4): ?>
            <a href="<?= site_url('bdi/tampilkan/' . ($start + 4)) ?>">Next</a>
        <?php endif; ?>
    </div>

    <button type="submit">Kirim Jawaban</button>
</form>

<a href="<?= site_url('kuesioner') ?>">Kembali ke Daftar Kuesioner</a>
<?= $this->endSection() ?>
