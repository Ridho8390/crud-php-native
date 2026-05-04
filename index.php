<?php
require_once 'config/koneksi.php';

$query = "SELECT * FROM siswa ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        th {
            background: #4CAF50;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #ddd;
        }
    </style>
</head>
<body>

<h2>Data Siswa</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Asal Sekolah</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Jurusan</th>
        <th>Keterangan</th>
        <th>Tanggal</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>$no</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['asal_sekolah']}</td>
                    <td>{$row['jenis_kelamin']}</td>
                    <td>{$row['agama']}</td>
                    <td>{$row['jurusan']}</td>
                    <td>{$row['keterangan']}</td>
                    <td>{$row['created_at']}</td>
                  </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='8'>Data tidak ada</td></tr>";
    }
    ?>
</table>

</body>
</html>