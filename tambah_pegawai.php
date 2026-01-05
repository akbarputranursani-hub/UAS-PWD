<?php
include 'koneksi.php';

$page_title = "Tambah Pegawai";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = mysqli_real_escape_string($koneksi, trim($_POST['password']));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $nama_lengkap = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap']));
    
    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Cek username sudah ada
    $check_query = "SELECT id FROM users WHERE username = '$username'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['pesan'] = "Username sudah digunakan!";
        $_SESSION['tipe'] = "error";
    } else {
        $query = "INSERT INTO users (username, password, email, nama_lengkap) 
                  VALUES ('$username', '$password_hash', '$email', '$nama_lengkap')";
        
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Pegawai berhasil ditambahkan!";
            $_SESSION['tipe'] = "success";
            header("Location: index.php?page=data_pegawai");
            exit();
        } else {
            $_SESSION['pesan'] = "Gagal menambahkan pegawai: " . mysqli_error($koneksi);
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
            <h2>Tambah Pegawai Baru</h2>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="index.php?page=data_pegawai">Data Pegawai</a>
                <i class="fas fa-chevron-right"></i>
                <span>Tambah Pegawai</span>
            </div>
        </div>
        
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Form Tambah Pegawai</h3>
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
                                <input type="text" id="username" name="username" required>
                                <small class="form-hint">Username untuk login</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">
                                    <i class="fas fa-lock"></i> Password *
                                </label>
                                <input type="password" id="password" name="password" required>
                                <small class="form-hint">Minimal 6 karakter</small>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_lengkap">
                                    <i class="fas fa-id-card"></i> Nama Lengkap
                                </label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" id="email" name="email">
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Pegawai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>