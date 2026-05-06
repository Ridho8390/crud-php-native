<?php
require_once 'config/koneksi.php';

// PROSES TAMBAH DATA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_siswa = trim($_POST['nama_siswa'] ?? '');
    $kelas      = trim($_POST['kelas'] ?? '');
    $tanggal    = $_POST['tanggal'] ?? '';
    $status     = $_POST['status'] ?? '';

    if ($nama_siswa == '' || $kelas == '' || $tanggal == '' || $status == '') {
        echo "<script>alert('Semua field wajib diisi!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO tb_absensi (nama_siswa, kelas, tanggal, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama_siswa, $kelas, $tanggal, $status);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal: " . $conn->error;
        }
    }
}

// AMBIL DATA
$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        h2 {
            text-align: center;
        }


        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
        }

        .btn-save {
            background: #4CAF50;
            color: white;
            font-size: 20px;
        }

        .btn-reset {
            background: #777;
            color: white;
            font-size: 20px;
        }

        .btn-back {
            background: #555;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        /* 🔥 INI BAGIAN PENTING (POSISI TOMBOL) */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .right-btn {
            display: flex;
            gap: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #4CAF50;
            color: white;
            padding: 10px;
        }

        td {
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .hadir { color: green; font-weight: bold; }
        .izin { color: orange; font-weight: bold; }
        .sakit { color: blue; font-weight: bold; }
        .alpa { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">

<h2>Data Absensi Siswa</h2>

<div class="card">
    <h3>Tambah Data Siswa</h3>

    <form method="POST">
        <label>Nama Siswa</label>
        <input type="text" name="nama_siswa">

        <label>Kelas</label>
        <input type="text" name="kelas">

        <label>Tanggal</label>
        <input type="date" name="tanggal">

        <label>Status</label>
        <select name="status">
            <option value="">-- Pilih --</option>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpa">Alpa</option>
        </select>

        <!-- 🔥 FOOTER TOMBOL -->
        <div class="form-footer">
            <!-- kiri -->
            <a href="index.php" class="btn btn-back">← Kembali</a>

            <!-- kanan -->
            <div class="right-btn">
                <button type="reset" class="btn btn-reset">Reset</button>
                <button type="submit" class="btn btn-save">Simpan</button>
            </div>
        </div>
    </form>
</div>

<!-- TABEL DATA -->
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>

    <?php $no = 1; ?>
    <?php while ($row = $result->fetch_assoc()) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
        <td><?= htmlspecialchars($row['kelas']); ?></td>
        <td><?= $row['tanggal']; ?></td>
        <td class="<?= strtolower($row['status']); ?>">
            <?= $row['status']; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</div>

</body>
</html>