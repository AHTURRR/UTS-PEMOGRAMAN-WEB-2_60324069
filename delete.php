<?php
require_once 'config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)));

if (!$id) {
    header('Location: index.php?pesan=id_tidak_valid');
    exit;
}

$stmt_check = $conn->prepare('SELECT id_kategori FROM kategori WHERE id_kategori = ?');
if (!$stmt_check) {
    header('Location: index.php?pesan=hapus_gagal');
    exit;
}

$stmt_check->bind_param('i', $id);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows === 0) {
    $stmt_check->close();
    header('Location: index.php?pesan=hapus_gagal');
    exit;
}

$stmt_check->close();

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
