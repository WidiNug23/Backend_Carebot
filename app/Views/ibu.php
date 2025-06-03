<!-- app/Views/ibu.php -->
<?= $this->extend('layouts/chatbot') ?>

<?= $this->section('title') ?>
Nutrisi Ibu Hamil dan Menyusui
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Informasi Nutrisi untuk Ibu Hamil dan Menyusui</h1>
    
    <h2>Nutrisi Ibu Hamil</h2>
    <?php if (!empty($nutrisi_hamil) && is_array($nutrisi_hamil)): ?>
        <div class="nutrisi-list">
            <?php foreach ($nutrisi_hamil as $key => $item): ?>
                <div class="nutrisi-item">
    <!-- Tambahkan gambar nutrisi -->
    <img src="<?= base_url('image/nutrisi/' . strtolower(str_replace(' ', '_', $item['nutrisi'])) . '.jpg'); ?>" alt="<?= esc($item['nutrisi']); ?>" class="nutrisi-image">
    
    <strong><?= esc($item['nutrisi']); ?> (<?= esc($item['jumlah']); ?>)</strong>
    <ul>
        <?php foreach (explode(',', $item['sumber']) as $sumber): ?>
            <li><?= esc(trim($sumber)); ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Dropdown for description -->
    <div class="description-dropdown">
        <h2 class="dropdown-header" onclick="toggleDescription('description<?= $key ?>')">
            Deskripsi <?= esc($item['nutrisi']); ?><span class="arrow">&#9662;</span>
        </h2>
        <div id="description<?= $key ?>" class="collapse">
            <p><?= esc($item['deskripsi']); ?></p>
        </div>
    </div>
</div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-data">Tidak ada data nutrisi untuk ibu hamil.</p>
    <?php endif; ?>
</div>

<script>
function toggleDescription(id) {
    var element = document.getElementById(id);
    var arrow = element.previousElementSibling.querySelector('.arrow');
    
    if (element.classList.contains('show')) {
        element.classList.remove('show');
        arrow.innerHTML = '&#9662;'; // Panah ke bawah
    } else {
        element.classList.add('show');
        arrow.innerHTML = '&#9652;'; // Panah ke atas
    }
}
</script>

<?= $this->endSection() ?>
