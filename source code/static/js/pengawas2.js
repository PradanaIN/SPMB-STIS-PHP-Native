/* ==================== NOTE ==================== */
/*
* File ini merupakan Konfigurasi untuk live search
* Live search ini ditujukan untuk pengawas
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
    xhr.open('GET', '../static/ajax/pengawas2.php?keyword=' + keyword.value, true);
    xhr.send();
}
);