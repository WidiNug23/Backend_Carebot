<?= $this->extend('layouts/chatbot') ?>

<?= $this->section('title') ?>
Nutrisi Remaja
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Informasi Nutrisi untuk Remaja</h1>
    
    <?php if (!empty($nutrisi) && is_array($nutrisi)): ?>
        <div class="nutrisi-list">
            <?php foreach ($nutrisi as $key => $item): ?>
                <div class="nutrisi-item">
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
                            <p><?= esc($item['deskripsi']); ?>. <!-- Ini bisa diambil dari database --> </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-data">Tidak ada data nutrisi untuk remaja.</p>
    <?php endif; ?>
</div>

<script>
function toggleDescription(id) {
    var element = document.getElementById(id);
    var arrow = element.previousElementSibling.querySelector('.arrow');
    
    if (element.classList.contains('show')) {
        element.classList.remove('show');
        arrow.innerHTML = '&#9662;'; // Down arrow
    } else {
        element.classList.add('show');
        arrow.innerHTML = '&#9652;'; // Up arrow
    }
}
</script>


<?= $this->endSection() ?>
