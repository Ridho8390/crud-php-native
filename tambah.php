<?php
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = trim($_POST['nama'] ?? '');
    $asal_sekolah = trim($_POST['asal_sekolah'] ?? '');
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $agama = $_POST['agama'] ?? '';
    $jurusan = $_POST['jurusan'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';

    // Validasi
    if ($nama == '' || $asal_sekolah == '' || $jenis_kelamin == '' || $agama == '' || $jurusan == '' || $keterangan == '') {
        echo "<script>alert('Semua field wajib diisi!');</script>";
    } else {

        $tanggal = date('Y-m-d H:i:s');

        $sql = "INSERT INTO siswa 
                (nama, asal_sekolah, jenis_kelamin, agama, jurusan, keterangan, created_at)
                VALUES 
                ('$nama', '$asal_sekolah', '$jenis_kelamin', '$agama', '$jurusan', '$keterangan', '$tanggal')";

        if ($conn->query($sql)) {
            echo "<script>alert('Data berhasil disimpan'); window.location='index.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Siswa</title>
</head>
<body>

<h2>Tambah Data Siswa</h2>

<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama"><br><br>

    <label>Asal Sekolah:</label><br>
    <input type="text" name="asal_sekolah"><br><br>

    <label>Jenis Kelamin:</label><br>
    <select name="jenis_kelamin">
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select><br><br>

    <label>Agama:</label><br>
    <input type="text" name="agama"><br><br>

    <label>Jurusan:</label><br>
    <input type="text" name="jurusan"><br><br>

    <label>Keterangan:</label><br>
    <select name="keterangan">
        <option value="">-- Pilih --</option>
        <option value="Diterima">Diterima</option>
        <option value="Ditolak">Ditolak</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>