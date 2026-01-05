<?php
include 'koneksi.php';

$page_title = "Detail Supplier";

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data supplier
$query  = "SELECT * FROM supplier WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$supplier = mysqli_fetch_assoc($result);

if (!$supplier) {
    $_SESSION['pesan'] = "Supplier tidak ditemukan!";
    $_SESSION['tipe']  = "error";
    header("Location: index.php?page=data_supplier");
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<div class="content-wrapper">
    <?php include 'includes/menu.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <h2>Detail Supplier</h2>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="index.php?page=data_supplier">Data Supplier</a>
                <i class="fas fa-chevron-right"></i>
                <span>Detail Supplier</span>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Informasi Supplier</h3>
                    <a href="index.php?page=data_supplier" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                
                <div class="card-body">
                    <form class="form-vertical">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="kode_perusahaan">
                                    <i class="fas fa-barcode"></i> Kode Supplier
                                </label>
                                <input type="text"
                                       id="kode_perusahaan"
                                       name="kode_perusahaan"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['kode_perusahaan']); ?>">
                            </div>

                            <div class="form-group">
                                <label for="nama_perusahaan">
                                    <i class="fas fa-building"></i> Nama Perusahaan
                                </label>
                                <input type="text"
                                       id="nama_perusahaan"
                                       name="nama_perusahaan"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['nama_perusahaan']); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_contact_person">
                                    <i class="fas fa-user"></i> Contact Person
                                </label>
                                <input type="text"
                                       id="nama_contact_person"
                                       name="nama_contact_person"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['nama_contact_person'] ?? '-'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['email'] ?? '-'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="no_telepon">
                                    <i class="fas fa-phone"></i> No Telepon
                                </label>
                                <input type="text"
                                       id="no_telepon"
                                       name="no_telepon"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['no_telepon'] ?? '-'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">
                                <i class="fas fa-map-marker-alt"></i> Alamat
                            </label>
                            <textarea id="alamat"
                                      name="alamat"
                                      rows="3"
                                      disabled><?php echo htmlspecialchars($supplier['alamat'] ?? '-'); ?></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="kota">
                                    <i class="fas fa-city"></i> Kota
                                </label>
                                <input type="text"
                                       id="kota"
                                       name="kota"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['kota'] ?? '-'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="provinsi">
                                    <i class="fas fa-map"></i> Provinsi
                                </label>
                                <input type="text"
                                       id="provinsi"
                                       name="provinsi"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['provinsi'] ?? '-'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="kode_pos">
                                    <i class="fas fa-mailbox"></i> Kode Pos
                                </label>
                                <input type="text"
                                       id="kode_pos"
                                       name="kode_pos"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['kode_pos'] ?? '-'); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="jenis_produk">
                                    <i class="fas fa-tags"></i> Jenis Produk
                                </label>
                                <input type="text"
                                       id="jenis_produk"
                                       name="jenis_produk"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['jenis_produk'] ?? '-'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="model_bisnis">
                                    <i class="fas fa-handshake"></i> Model Bisnis
                                </label>
                                <input type="text"
                                       id="model_bisnis"
                                       name="model_bisnis"
                                       disabled
                                       value="<?php echo htmlspecialchars($supplier['model_bisnis'] ?? '-'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-align-left"></i> Keterangan
                            </label>
                            <textarea id="keterangan"
                                      name="keterangan"
                                      rows="4"
                                      disabled><?php echo htmlspecialchars($supplier['keterangan'] ?? '-'); ?></textarea>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>