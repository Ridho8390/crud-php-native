<?php
require_once 'config/koneksi.php';

$id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);

if (!$id) {
    die("ID tidak valid!");
}

$stmt = $conn->prepare("DELETE FROM tb_absensi WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal hapus: " . $conn->error;
}