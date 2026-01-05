<?php
include 'koneksi.php';

$page_title = "Tambah Supplier";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_perusahaan = mysqli_real_escape_string($koneksi, trim($_POST['kode_perusahaan']));
    $nama_perusahaan = mysqli_real_escape_string($koneksi, trim($_POST['nama_perusahaan']));
    $nama_contact_person = mysqli_real_escape_string($koneksi, trim($_POST['nama_contact_person']));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $no_telepon = mysqli_real_escape_string($koneksi, trim($_POST['no_telepon']));
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST['alamat']));
    $kota = mysqli_real_escape_string($koneksi, trim($_POST['kota']));
    $provinsi = mysqli_real_escape_string($koneksi, trim($_POST['provinsi']));
    $kode_pos = mysqli_real_escape_string($koneksi, trim($_POST['kode_pos']));
    $jenis_produk = mysqli_real_escape_string($koneksi, trim($_POST['jenis_produk']));
    $model_bisnis = mysqli_real_escape_string($koneksi, trim($_POST['model_bisnis']));
    $keterangan = mysqli_real_escape_string($koneksi, trim($_POST['keterangan']));
    
    // Generate kode otomatis jika kosong
    if (empty($kode_perusahaan)) {
        $prefix = "SUP";
        $query = "SELECT MAX(SUBSTRING(kode_perusahaan, 4)) as max_code FROM supplier WHERE kode_perusahaan LIKE '$prefix%'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        $next_num = ($row['max_code'] ?? 0) + 1;
        $kode_perusahaan = $prefix . str_pad($next_num, 3, '0', STR_PAD_LEFT);
    }
    
    // Cek kode sudah ada
    $check_query = "SELECT id FROM supplier WHERE kode_perusahaan = '$kode_perusahaan'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['pesan'] = "Kode supplier sudah digunakan!";
        $_SESSION['tipe'] = "error";
    } else {
        $query = "INSERT INTO supplier (kode_perusahaan, nama_perusahaan, nama_contact_person, email, no_telepon, alamat, kota, provinsi, kode_pos, jenis_produk, model_bisnis, keterangan) 
                  VALUES ('$kode_perusahaan', '$nama_perusahaan', '$nama_contact_person', '$email', '$no_telepon', '$alamat', '$kota', '$provinsi', '$kode_pos', '$jenis_produk', '$model_bisnis', '$keterangan')";
        
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Supplier berhasil ditambahkan!";
            $_SESSION['tipe'] = "success";
            header("Location: index.php?page=data_supplier");
            exit();
        } else {
            $_SESSION['pesan'] = "Gagal menambahkan supplier: " . mysqli_error($koneksi);
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
            <h2>Tambah Supplier Baru</h2>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="index.php?page=data_supplier">Data Supplier</a>
                <i class="fas fa-chevron-right"></i>
                <span>Tambah Supplier</span>
            </div>
        </div>
        
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Form Tambah Supplier</h3>
                    <a href="index.php?page=data_supplier" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                
                <div class="card-body">
                    <form method="POST" class="form-vertical">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="kode_perusahaan">
                                    <i class="fas fa-barcode"></i> Kode Supplier
                                </label>
                                <input type="text" id="kode_perusahaan" name="kode_perusahaan" 
                                       placeholder="Kosongkan untuk generate otomatis">
                                <small class="form-hint">Contoh: SUP001</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="nama_perusahaan">
                                    <i class="fas fa-building"></i> Nama Perusahaan *
                                </label>
                                <input type="text" id="nama_perusahaan" name="nama_perusahaan" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_contact_person">
                                    <i class="fas fa-user"></i> Contact Person
                                </label>
                                <input type="text" id="nama_contact_person" name="nama_contact_person">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" id="email" name="email">
                            </div>
                            
                            <div class="form-group">
                                <label for="no_telepon">
                                    <i class="fas fa-phone"></i> No Telepon
                                </label>
                                <input type="text" id="no_telepon" name="no_telepon">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="alamat">
                                <i class="fas fa-map-marker-alt"></i> Alamat
                            </label>
                            <textarea id="alamat" name="alamat" rows="3" 
                                      placeholder="Alamat lengkap supplier..."></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="kota">
                                    <i class="fas fa-city"></i> Kota
                                </label>
                                <input type="text" id="kota" name="kota">
                            </div>
                            
                            <div class="form-group">
                                <label for="provinsi">
                                    <i class="fas fa-map"></i> Provinsi
                                </label>
                                <input type="text" id="provinsi" name="provinsi">
                            </div>
                            
                            <div class="form-group">
                                <label for="kode_pos">
                                    <i class="fas fa-mailbox"></i> Kode Pos
                                </label>
                                <input type="text" id="kode_pos" name="kode_pos">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="jenis_produk">
                                    <i class="fas fa-tags"></i> Jenis Produk
                                </label>
                                <input type="text" id="jenis_produk" name="jenis_produk" 
                                       placeholder="Contoh: Elektronik, Pakaian, dll">
                            </div>
                            
                            <div class="form-group">
                                <label for="model_bisnis">
                                    <i class="fas fa-handshake"></i> Model Bisnis
                                </label>
                                <select id="model_bisnis" name="model_bisnis">
                                    <option value="">Pilih Model Bisnis</option>
                                    <option value="Distributor">Distributor</option>
                                    <option value="Wholesaler">Wholesaler</option>
                                    <option value="Manufacturer">Manufacturer</option>
                                    <option value="Retailer">Retailer</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-align-left"></i> Keterangan
                            </label>
                            <textarea id="keterangan" name="keterangan" rows="4" 
                                      placeholder="Keterangan tambahan tentang supplier..."></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Supplier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>