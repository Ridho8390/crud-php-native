<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_siswa = trim($_POST['nama_siswa'] ?? '');
    $kelas      = trim($_POST['kelas'] ?? '');
    $tanggal    = $_POST['tanggal'] ?? '';
    $status     = $_POST['status'] ?? '';

    // Validasi sederhana
    if ($nama_siswa === '' || $kelas === '' || $tanggal === '' || $status === '') {
        die("Semua field wajib diisi!");
    }

    // Contoh tambahan: batasi status
    $allowed_status = ['Hadir', 'Izin', 'Sakit', 'Alpa'];
    if (!in_array($status, $allowed_status)) {
        die("Status tidak valid!");
    }

    // Lanjutkan ke proses simpan ke database...
}
?>