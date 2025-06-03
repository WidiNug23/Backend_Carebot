document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navbarLinks = document.getElementById('navbar-links');

    menuToggle.addEventListener('click', function() {
        menuToggle.classList.toggle('active');
        navbarLinks.classList.toggle('active');
    });
});

const functions = require('firebase-functions');
const axios = require('axios');

exports.dialogflowFirebaseFulfillment = functions.https.onRequest(async (req, res) => {
  try {
    // Ambil data dari endpoint yang diberikan
    const response = await axios.get('http://localhost:8080/index.php/remaja/getNutrisiPayload');
    const data = response.data;

    // Kembalikan data yang diambil ke Dialogflow
    res.json(data);
  } catch (error) {
    console.error(error);
    res.status(500).send('Terjadi kesalahan saat mengambil data');
  }
});
