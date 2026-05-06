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

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 85%;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background: #4CAF50;
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

    </style>
</head>
<body>

<h2>Data Absensi Siswa</h2>

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

</body>
</html>