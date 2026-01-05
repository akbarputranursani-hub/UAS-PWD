<?php
include 'koneksi.php';

$page_title = "Detail Barang";

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data barang
$query  = "SELECT * FROM barang WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$barang = mysqli_fetch_assoc($result);

if (!$barang) {
    $_SESSION['pesan'] = "Barang tidak ditemukan!";
    $_SESSION['tipe']  = "error";
    header("Location: index.php?page=data_barang");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = mysqli_real_escape_string($koneksi, trim($_POST['kode_barang']));
    $nama_barang = mysqli_real_escape_string($koneksi, trim($_POST['nama_barang']));
    $kategori = mysqli_real_escape_string($koneksi, trim($_POST['kategori']));
    $stok = mysqli_real_escape_string($koneksi, trim($_POST['stok']));
    $harga = mysqli_real_escape_string($koneksi, trim($_POST['harga']));
    $deskripsi = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));
    $status = mysqli_real_escape_string($koneksi, trim($_POST['status']));
}
?>
<?php include 'includes/header.php'; ?>

<div class="content-wrapper">
    <?php include 'includes/menu.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <h2>Detail Barang</h2>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="index.php?page=data_barang">Data Barang</a>
                <i class="fas fa-chevron-right"></i>
                <span>Edit Barang</span>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <div class="card-body">
                    <form method="POST" class="form-vertical">

                        <div class="form-group">
                            <label for="kode_barang">
                                <i class="fas fa-barcode"></i> Kode Barang *
                            </label>
                            <input type="text"
                                   id="kode_barang"
                                   name="kode_barang"
                                   disabled
                                   value="<?php echo htmlspecialchars($barang['kode_barang']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="nama_barang">
                                <i class="fas fa-box"></i> Nama Barang *
                            </label>
                            <input type="text"
                                   id="nama_barang"
                                   name="nama_barang"
                                   disabled
                                   value="<?php echo htmlspecialchars($barang['nama_barang']); ?>">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="stok">
                                    <i class="fas fa-cubes"></i> Stok *
                                </label>
                                <input type="number"
                                       id="stok"
                                       name="stok"
                                       disabled
                                       value="<?php echo $barang['stok']; ?>"
                                       min="0"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="harga">
                                    <i class="fas fa-money-bill-wave"></i> Harga (Rp) *
                                </label>
                                <input type="number"
                                       id="harga"
                                       name="harga"
                                       disabled
                                       value="<?php echo $barang['harga']; ?>"
                                       min="0"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">
                                <i class="fas fa-align-left"></i> Deskripsi
                            </label>
                            <textarea id="deskripsi"
                                      name="deskripsi"
                                      rows="4"
                                      disabled><?php echo htmlspecialchars($barang['deskripsi']); ?></textarea>
                        </div>

                        <div class="card-header">
                            <a href="index.php?page=data_barang" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
