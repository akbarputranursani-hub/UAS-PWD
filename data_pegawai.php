<?php
    // Query data users/pegawai
    include 'koneksi.php';
    $query = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($koneksi, $query);
?>

<div class="card">
    <div class="card-header">
        <h3>DATA PEGAWAI</h3>
        <div class="card-actions">
            <a href="tambah_pegawai.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pegawai
            </a>
            <button class="btn btn-secondary" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>
    
    <div class="card-body">
                
        <!-- Tabel Data Pegawai -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($row['username']); ?></strong>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row['nama_lengkap'] ?? '-'); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row['email'] ?? '-'); ?>
                            </td>
                            <td class="action-buttons">
                                <a href="edit_pegawai.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus_pegawai.php?id=<?php echo $row['id']; ?>" 
                                   class="btn-action btn-delete" 
                                   title="Hapus"
                                   onclick="return confirm('Yakin hapus pegawai ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="detail_pegawai.php?id=<?php echo $row['id']; ?>" class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="empty-state">
                                    <i class="fas fa-users fa-3x"></i>
                                    <h4>Belum ada data pegawai</h4>
                                    <p>Mulai dengan menambahkan pegawai baru</p>
                                    <a href="tambah_pegawai.php" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Pegawai Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>