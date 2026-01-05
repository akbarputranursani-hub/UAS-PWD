<?php
include 'koneksi.php';

$page_title = "Edit Pegawai";

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data pegawai
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$pegawai = mysqli_fetch_assoc($result);

if (!$pegawai) {
    $_SESSION['pesan'] = "Pegawai tidak ditemukan!";
    $_SESSION['tipe'] = "error";
    header("Location: index.php?page=data_pegawai");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = mysqli_real_escape_string($koneksi, trim($_POST['password']));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $nama_lengkap = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap']));
    
    // Cek username unik (kecuali untuk pegawai ini)
    $check_query = "SELECT id FROM users WHERE username = '$username' AND id != $id";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['pesan'] = "Username sudah digunakan!";
        $_SESSION['tipe'] = "error";
    } else {
        // Update dengan atau tanpa password
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET 
                      username = '$username',
                      password = '$password_hash',
                      email = '$email',
                      nama_lengkap = '$nama_lengkap'
                      WHERE id = $id";
        } else {
            $query = "UPDATE users SET 
                      username = '$username',
                      email = '$email',
                      nama_lengkap = '$nama_lengkap'
                      WHERE id = $id";
        }
        
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Pegawai berhasil diperbarui!";
            $_SESSION['tipe'] = "success";
            header("Location: index.php?page=data_pegawai");
            exit();
        } else {
            $_SESSION['pesan'] = "Gagal memperbarui pegawai: " . mysqli_error($koneksi);
            $_SESSION['tipe'] = "error";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="content-wrapper">
    <?php include 'includes/menu.php'; ?>
    
    <main class="main-content">
        <div class="page-header">
            <h2>Edit Pegawai</h2>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="index.php?page=data_pegawai">Data Pegawai</a>
                <i class="fas fa-chevron-right"></i>
                <span>Edit Pegawai</span>
            </div>
        </div>
        
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Data Pegawai</h3>
                    <a href="index.php?page=data_pegawai" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                
                <div class="card-body">
                    <form method="POST" class="form-vertical">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="username">
                                    <i class="fas fa-user"></i> Username *
                                </label>
                                <input type="text" id="username" name="username" 
                                       value="<?php echo htmlspecialchars($pegawai['username']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <input type="password" id="password" name="password">
                                <small class="form-hint">Kosongkan jika tidak ingin mengubah password</small>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_lengkap">
                                    <i class="fas fa-id-card"></i> Nama Lengkap
                                </label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" 
                                       value="<?php echo htmlspecialchars($pegawai['nama_lengkap'] ?? ''); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" id="email" name="email" 
                                       value="<?php echo htmlspecialchars($pegawai['email'] ?? ''); ?>">
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>