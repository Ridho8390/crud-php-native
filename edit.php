<?php
require_once 'config/koneksi.php';

// Ambil ID dari URL
$id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);

if (!$id) {
    die("ID tidak valid!");
}

// Ambil data berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM tb_absensi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan!");
}

// PROSES UPDATE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_siswa = trim($_POST['nama_siswa']);
    $kelas      = trim($_POST['kelas']);
    $tanggal    = $_POST['tanggal'];
    $status     = $_POST['status'];

    if ($nama_siswa == '' || $kelas == '' || $tanggal == '' || $status == '') {
        echo "<script>alert('Semua field wajib diisi!');</script>";
    } else {
        $stmt = $conn->prepare("UPDATE tb_absensi SET nama_siswa=?, kelas=?, tanggal=?, status=? WHERE id=?");
        $stmt->bind_param("ssssi", $nama_siswa, $kelas, $tanggal, $status, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal update: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>

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

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
        }

        .right-btn {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
            text-decoration: none;
            color: white;
        }

        .btn-back { background: #555; }
        .btn-save { background: #4CAF50; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">

        <h3>Edit Data Siswa</h3>

        <form method="POST">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" value="<?= htmlspecialchars($data['nama_siswa']) ?>">

            <label>Kelas</label>
            <input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']) ?>">

            <label>Tanggal</label>
            <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>">

            <label>Status</label>
            <select name="status">
                <option <?= $data['status']=='Hadir'?'selected':'' ?>>Hadir</option>
                <option <?= $data['status']=='Izin'?'selected':'' ?>>Izin</option>
                <option <?= $data['status']=='Sakit'?'selected':'' ?>>Sakit</option>
                <option <?= $data['status']=='Alpa'?'selected':'' ?>>Alpa</option>
            </select>

            <div class="form-footer">
                <a href="index.php" class="btn btn-back">← Kembali</a>

                <div class="right-btn">
                    <button type="submit" class="btn btn-save">Update</button>
                </div>
            </div>
        </form>

    </div>
</div>

</body>
</html>