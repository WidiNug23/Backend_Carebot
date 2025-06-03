<?= $this->extend('layouts/chatbot') ?>

<?= $this->section('title') ?>
Beranda
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="slider-container">
    <div class="slider">
        <div class="slide">
            <div class="image-container">
                <img src="assets/image/1.png" alt="Deskripsi gambar 1">
            </div>
        </div>
        <div class="slide">
            <div class="image-container">
                <img src="assets/image/2.png" alt="Deskripsi gambar 2">
            </div>
        </div>
        <div class="slide">
            <div class="image-container">
                <img src="assets/image/3.png" alt="Deskripsi gambar 3">
            </div>
        </div>
        <!-- Tambahkan slide lain sesuai kebutuhan -->
    </div>
    <!-- Kontrol slider -->
    <div class="slider-controls">
        <button class="prev-slide">&laquo;</button>
        <button class="next-slide">&raquo;</button>
    </div>
</div>

<!-- Menu di bawah slider -->
<div class="menu-container">
    <div class="menu-item" onclick="location.href='<?= site_url('remaja') ?>'">
        <img src="assets/image/teenagers.jpg" alt="Nutrisi Remaja">
        <h3>Nutrisi Remaja</h3>
        <p>Informasi tentang nutrisi penting untuk remaja.</p>
    </div>
    <div class="menu-item" onclick="location.href='<?= site_url('lansia') ?>'">
        <img src="assets/image/oldman.jpg" alt="Nutrisi Lansia">
        <h3>Nutrisi Lansia</h3>
        <p>Panduan nutrisi untuk lansia agar tetap sehat.</p>
    </div>
    <div class="menu-item" onclick="location.href='<?= site_url('ibu') ?>'">
        <img src="assets/image/pregnant.jpg" alt="Nutrisi Ibu Hamil">
        <h3>Nutrisi Ibu Hamil</h3>
        <p>Kebutuhan nutrisi untuk ibu hamil dan menyusui.</p>
    </div>
    <div class="menu-item" onclick="location.href='<?= site_url('ibu_menyusui') ?>'">
        <img src="assets/image/mom.jpg" alt="Nutrisi Keluarga">
        <h3>Nutrisi Ibu Menyusui</h3>
        <p>Tips dan panduan nutrisi untuk ibu menyusui.</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        const prevButton = document.querySelector('.prev-slide');
        const nextButton = document.querySelector('.next-slide');
        let currentIndex = 0;

        function showSlide(index) {
            const slideWidth = slides[0].clientWidth;
            slider.style.transform = `translateX(-${index * slideWidth}px)`;
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        }

        // Event listeners for navigation buttons
        nextButton.addEventListener('click', nextSlide);
        prevButton.addEventListener('click', prevSlide);

        // Auto slide change every 5 seconds
        setInterval(nextSlide, 5000);

        // Update slide width on window resize
        window.addEventListener('resize', () => {
            showSlide(currentIndex);
        });
    });
</script>

<?= $this->endSection() ?>
