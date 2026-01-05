<?php
include 'koneksi.php';

//ambil id dari url
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $query = "DELETE FROM supplier WHERE id = $id";

    if (mysqli_query($koneksi, $query)){
        $_SESSION['pesan'] = "Supplier berhasil dihapus!";
        $_SESSION['tipe'] = "success";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus supplier: " . mysqli_error($koneksi);
        $_SESSION['tipe'] = "error";
    }
}

header("Location: index.php?page=data_supplier");
exit();
?>