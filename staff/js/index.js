setInterval(() => {
  const now = new Date();
  document.getElementById("jam-digital").innerText = now.toLocaleTimeString();
}, 1000);

const lokasiInfo = document.getElementById("lokasi-info");
const btnAbsen = document.getElementById("btn-absen");
const inputLat = document.getElementById("latitude");
const inputLong = document.getElementById("longitude");

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition, showError);
} else {
  lokasiInfo.innerHTML = "Geolocation tidak didukung browser ini.";
}

function showPosition(position) {
  inputLat.value = position.coords.latitude;
  inputLong.value = position.coords.longitude;
  lokasiInfo.innerHTML = `<span class="text-success">📍 Lokasi Terkunci: ${position.coords.latitude}, ${position.coords.longitude}</span>`;
  if (btnAbsen) btnAbsen.disabled = false;
}

function showError(error) {
  lokasiInfo.innerHTML =
    "Gagal mendeteksi lokasi. Pastikan GPS aktif/diizinkan.";
}
