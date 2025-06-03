<!-- app/Views/chatbot.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/styles.css') ?>">
    <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (untuk komponen seperti Collapse) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <!-- Logo -->
        <div class="navbar-logo">
            <a href="<?= site_url('') ?>">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="logo">
            </a>
        </div>
        <!-- Menu Toggle (Hamburger) -->
        <div class="menu-toggle" id="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <!-- Navbar Links -->
        <div class="navbar-links" id="navbar-links">
            <button onclick="location.href='<?= site_url('lansia') ?>'">Nutrisi Lansia</button>
            <button onclick="location.href='<?= site_url('ibu') ?>'">Nutrisi Ibu Hamil</button>
            <button onclick="location.href='<?= site_url('ibu_menyusui') ?>'">Nutrisi Ibu Menyusui</button>
            <button onclick="location.href='<?= site_url('remaja') ?>'">Nutrisi Remaja Putri</button>
            <!-- <button onclick="location.href='<?= site_url('kalkulator_gizi') ?>'">Hitung Gizi</button> -->
            <!-- <button onclick="location.href='<?= site_url('login') ?>'">Login</button> -->
        </div>
    </div>

    <!-- Konten yang berubah-ubah -->
    <?= $this->renderSection('content') ?>

    <!-- Kode Dialogflow Messenger -->
    <df-messenger
        intent="WELCOME"
        chat-title="CareBot"
        agent-id="2b375627-4601-495e-be1a-792f88069133"
        language-code="id"
        chat-icon="https://uxwing.com/wp-content/themes/uxwing/download/communication-chat-call/chat-icon.png" 
    ></df-messenger>
    <style>
    df-messenger {
        --df-messenger-bot-message: #f8c6d6; /* Warna latar pesan bot */
        --df-messenger-button-titlebar-color: #f76c6c; /* Warna latar tombol titlebar */
        --df-messenger-chat-background-color: #ffeef2; /* Warna latar chat */
        --df-messenger-font-color: #333; /* Warna font */
        --df-messenger-send-icon: #f76c6c; /* Warna ikon kirim */
        --df-messenger-user-message: #f8a4b4; /* Warna latar pesan pengguna */
    }
</style>

    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <p>&copy; <?= date("Y"); ?> Nama Website. Semua hak cipta dilindungi.</p>
            </div>
            <div class="footer-right">
                <a href="#about-us">Tentang Kami</a>
                <a href="#contact">Kontak</a>
                <a href="#privacy-policy">Kebijakan Privasi</a>
                <a href="#terms">Syarat dan Ketentuan</a>
            </div>
        </div>
    </footer>

    <!-- Script tambahan untuk mengatur scrolling -->
    <script>
        // Fungsi untuk menambahkan pesan ke chat container
        function addMessageToChat(message) {
            const chatContainer = document.querySelector('.chat-container');
            
            // Buat elemen pesan baru
            const messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.textContent = message;
            
            // Tambahkan pesan ke chat container
            chatContainer.appendChild(messageElement);
            
            // Jangan scroll otomatis ke bawah
            // Jika ingin scroll otomatis ke bawah saat chat pertama kali muncul, aktifkan ini
            // chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        document.addEventListener('DOMContentLoaded', function() {
    const dfMessenger = document.querySelector('df-messenger');

    if (dfMessenger) {
        // Misalnya, sembunyikan elemen tertentu atau atur gaya secara dinamis
        dfMessenger.style.borderRadius = '10px';
        dfMessenger.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
        
        // Atau Anda bisa memodifikasi elemen yang ada di dalamnya
        dfMessenger.shadowRoot.querySelector('.some-class').style.backgroundColor = '#ff4081';
    }
});

    </script>
</body>
</html>
