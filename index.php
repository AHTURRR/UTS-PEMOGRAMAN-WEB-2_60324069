<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once 'config/database.php';
    
    // Query data kategori menggunakan prepared statement
    $stmt = $conn->prepare("SELECT id_kategori, kode_kategori, nama_kategori, deskripsi, status FROM kategori ORDER BY id_kategori DESC");

    if (!$stmt) {
        die("Query gagal: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query gagal: " . $conn->error);
    }
    ?>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Kategori Buku</h2>
            <a href="create.php" class="btn btn-primary">Tambah Kategori</a>
        </div>
        
        <!-- Menampilkan pesan jika ada aksi (opsional tapi bagus untuk user experience) -->
        <?php if (isset($_GET['pesan'])): ?>
            <?php if ($_GET['pesan'] == 'sukses'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data berhasil disimpan!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['pesan'] == 'error'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data tidak ditemukan!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['pesan'] == 'hapus_sukses'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data berhasil dihapus!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['pesan'] == 'hapus_gagal'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data gagal dihapus!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['pesan'] == 'id_tidak_valid'): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ID tidak valid!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="100">Kode</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th width="100">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // 2. Tampil dalam tabel dengan nomor urut dinamis (Kriteria 8 poin)
                        $no = 1; // Inisialisasi angka mulai dari 1
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                
                                // 3. Logika Badge Status (Kriteria 4 poin)
                                // Jika status Aktif = hijau (bg-success), selain itu merah (bg-danger)
                                $badge_class = ($row['status'] == 'Aktif') ? 'bg-success' : 'bg-danger';
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <!-- Contoh jika nama kolom di database adalah kode_kategori -->
                                    <td><?= htmlspecialchars($row['kode_kategori']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                                    <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                                    <td>
                                        <span class="badge <?= $badge_class; ?>">
                                            <?= htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <!-- 4. Tombol Aksi (Kriteria 3 poin) -->
                                        <a href="edit.php?id=<?= $row['id_kategori']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <button type="button" onclick="confirmDelete(<?= $row['id_kategori']; ?>)" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            // Tampilan jika database masih kosong
                            echo '<tr><td colspan="6" class="text-center">Belum ada data kategori.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script>
    function confirmDelete(id) {
        if (confirm('Yakin ingin menghapus kategori ini?')) {
            window.location.href = 'delete.php?id=' + id;
        }
    }
    </script>
    <?php $stmt->close(); ?>
    
    <!-- Jangan lupa tambahkan script JS Bootstrap agar fitur seperti alert close bisa jalan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>