<?php
include 'koneksi.php';

$page_title = "Detail Pegawai";

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data pegawai
$query  = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$pegawai = mysqli_fetch_assoc($result);

if (!$pegawai) {
    $_SESSION['pesan'] = "Pegawai tidak ditemukan!";
    $_SESSION['tipe']  = "error";
    header("Location: index.php?page=data_pegawai");
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<div class="content-wrapper">
    <?php include 'includes/menu.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <h2>Detail Pegawai</h2>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="index.php?page=data_pegawai">Data Pegawai</a>
                <i class="fas fa-chevron-right"></i>
                <span>Detail Pegawai</span>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Informasi Pegawai</h3>
                    <a href="index.php?page=data_pegawai" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                
                <div class="card-body">
                    <form class="form-vertical">

                        <div class="form-group">
                            <label for="username">
                                <i class="fas fa-user"></i> Username
                            </label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   disabled
                                   value="<?php echo htmlspecialchars($pegawai['username']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="nama_lengkap">
                                <i class="fas fa-id-card"></i> Nama Lengkap
                            </label>
                            <input type="text"
                                   id="nama_lengkap"
                                   name="nama_lengkap"
                                   disabled
                                   value="<?php echo htmlspecialchars($pegawai['nama_lengkap'] ?? '-'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   disabled
                                   value="<?php echo htmlspecialchars($pegawai['email'] ?? '-'); ?>">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>