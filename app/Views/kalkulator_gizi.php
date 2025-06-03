<?= $this->extend('layouts/chatbot') ?>

<?= $this->section('content') ?>
<head><link rel="stylesheet" href="<?= base_url('assets/kalkulator.css') ?>">
</head>
<main class="calculator-container">
    <div class="form-section">
        <h1>Kalkulator Gizi Harian</h1>
        <form action="/kalkulator_gizi/calculate" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select name="gender" id="gender" required>
                    <option value="male">Pria</option>
                    <option value="female">Wanita</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="weight">Berat Badan (kg):</label>
                <input type="number" id="weight" name="weight" required>
            </div>

            <div class="form-group">
                <label for="height">Tinggi Badan (cm):</label>
                <input type="number" id="height" name="height" required>
            </div>

            <div class="form-group">
                <label for="age">Usia:</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div class="form-group">
                <label for="activity">Tingkat Aktivitas:</label>
                <select name="activity" id="activity" required>
                    <option value="1.2">Sedentary (sedikit atau tanpa latihan)</option>
                    <option value="1.375">Ringan (latihan ringan/sedikit aktif)</option>
                    <option value="1.55">Sedang (latihan moderat/aktif)</option>
                    <option value="1.725">Aktif (latihan berat/sangat aktif)</option>
                    <option value="1.9">Sangat Aktif (latihan sangat berat)</option>
                </select>
            </div>

            <button type="submit">Hitung</button>
        </form>
    </div>

    <div class="result-section">
        <?php if (isset($tdee)): ?>
            <div class="result">
                <h3>Hasil Perhitungan Gizi Harian</h3>
                <p>Total Kebutuhan Kalori (TDEE): <?= $tdee ?> kalori/hari</p>
                <p>Karbohidrat: <?= $carbs ?> gram/hari</p>
                <p>Protein: <?= $protein ?> gram/hari</p>
                <p>Lemak: <?= $fat ?> gram/hari</p>
            </div>
        <?php endif; ?>
    </div>
</main>
<?= $this->endSection() ?>
