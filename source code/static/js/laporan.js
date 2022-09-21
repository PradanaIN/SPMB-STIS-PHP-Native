/* ==================== NOTE ==================== */
/*
* File ini merupakan Konfigurasi untuk live search
* Live search ini ditujukan untuk admin
* Karena nantinya admin memiliki kolom Aksi
*/
/* ==================== NOTE ==================== */

/* ========= AJAX CARI DATA ========= */
// Mengambil elemen yang dibutuhkan
var keyword = document.getElementById('keyword');
var content = document.getElementById('content');

// Trigger event ketika keyword ditulis
keyword.addEventListener('keyup', function () {
    // Konfigurasi Ajax
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            content.innerHTML = xhr.responseText;
        }
    }
    xhr.open('GET', '../static/ajax/laporan.php?keyword=' + keyword.value, true);
    xhr.send();
}
);