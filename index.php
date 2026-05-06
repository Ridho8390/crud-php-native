<?php
require_once 'config/koneksi.php';

// Query ambil data
$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);

// Cek query
if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .top-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 15px;
            background: #4CAF50;
            color: white;
            font-size: 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background: black;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #e0f7e9;
        }

        /* Warna status */
        .hadir { color: green; font-weight: bold; }
        .izin { color: orange; font-weight: bold; }
        .sakit { color: blue; font-weight: bold; }
        .alpa { color: red; font-weight: bold; }

        /* 🔥 AKSI */
        .aksi {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-edit {
            background: black;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-hapus {
            background: black;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: #333;
        }

        .btn-hapus:hover {
            background: #333;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Data Absensi Siswa</h2>

    <!-- Tombol Tambah -->
    <div class="top-bar">
        <a href="tambah.php" class="btn">+ Tambah Data</a>
    </div>

    <!-- Tabel -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
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

                <!-- 🔥 AKSI -->
                <td class="aksi">
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">🖉</a>

                    <a href="hapus.php?id=<?= $row['id']; ?>" 
                       class="btn-hapus"
                       onclick="return confirm('Yakin mau hapus data ini?')">🗑️</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Data masih kosong</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>