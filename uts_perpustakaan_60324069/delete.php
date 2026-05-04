<?php
require_once 'config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)));

if (!$id) {
    header('Location: index.php?pesan=id_tidak_valid');
    exit;
}

$stmt = $conn->prepare('DELETE FROM kategori WHERE id_kategori = ?');

if (!$stmt) {
    header('Location: index.php?pesan=hapus_gagal');
    exit;
}

$stmt->bind_param('i', $id);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    $stmt->close();
    header('Location: index.php?pesan=hapus_sukses');
    exit;
}

$stmt->close();
header('Location: index.php?pesan=hapus_gagal');
exit;
