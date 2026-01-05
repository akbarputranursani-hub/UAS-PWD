<?php
    // Query data supplier
    include 'koneksi.php';
    $query = "SELECT * FROM supplier ORDER BY id DESC";
    $result = mysqli_query($koneksi, $query);
?>

<div class="card">
    <div class="card-header">
        <h3>DATA SUPPLIER</h3>
        <div class="card-actions">
            <a href="tambah_supplier.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Supplier
            </a>
            <button class="btn btn-secondary" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>
    
    <div class="card-body">
                
        <!-- Tabel Data Supplier -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Supplier</th>
                        <th>Nama Perusahaan</th>
                        <th>Contact Person</th>
                        <th>No Telepon</th>
                        <th>Kota</th>
                        <th>Jenis Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($row['kode_perusahaan']); ?></strong>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row['nama_perusahaan']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row['nama_contact_person'] ?? '-'); ?>
                            </td>
                            <td>
                                <span class="text-primary">
                                    <i class="fas fa-phone"></i> <?php echo htmlspecialchars($row['no_telepon'] ?? '-'); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row['kota'] ?? '-'); ?>, <?php echo htmlspecialchars($row['provinsi'] ?? '-'); ?>
                            </td>
                            <td>
                                <span class="badge badge-info">
                                    <?php echo htmlspecialchars($row['jenis_produk'] ?? '-'); ?>
                                </span>
                            </td>
                            <td class="action-buttons">
                                <a href="edit_supplier.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="hapus_supplier.php?id=<?php echo $row['id']; ?>" 
                                   class="btn-action btn-delete" 
                                   title="Hapus"
                                   onclick="return confirm('Yakin hapus supplier ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="detail_supplier.php?id=<?php echo $row['id']; ?>" class="btn-action btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="empty-state">
                                    <i class="fas fa-truck fa-3x"></i>
                                    <h4>Belum ada data supplier</h4>
                                    <p>Mulai dengan menambahkan supplier baru</p>
                                    <a href="tambah_supplier.php" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Supplier Pertama
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