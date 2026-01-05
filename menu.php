<?php
// Data menu
$menu_items = array(
    'dashboard' => array(
        'icon' => 'fas fa-home',
        'title' => 'Dashboard',
        'link' => 'index.php',
        'active' => (basename($_SERVER['PHP_SELF']) == 'index.php')
    ),
    'data_barang' => array(
        'icon' => 'fas fa-box',
        'title' => 'Data Barang',
        'link' => 'index.php?page=data_barang',
        'active' => (isset($_GET['page']) && $_GET['page'] == 'data_barang') || 
                   (basename($_SERVER['PHP_SELF']) == 'tambah_barang.php') ||
                   (basename($_SERVER['PHP_SELF']) == 'edit_barang.php')
    ),
    'data_supplier' => array(
        'icon' => 'fas fa-truck',
        'title' => 'Data Supplier',
        'link' => 'index.php?page=data_supplier',
        'active' => (isset($_GET['page']) && $_GET['page'] == 'data_supplier') || 
                   (basename($_SERVER['PHP_SELF']) == 'tambah_supplier.php') || 
                   (basename($_SERVER['PHP_SELF']) == 'edit_supplier.php')
    ),
    'data_pegawai' => array(
        'icon' => 'fas fa-user',
        'title' => 'Data Pegawai',
        'link' => 'index.php?page=data_pegawai',
        'active' => (isset($_GET['page']) && $_GET['page'] == 'data_pegawai') || 
                   (basename($_SERVER['PHP_SELF']) == 'tambah_pegawai.php') ||
                   (basename($_SERVER['PHP_SELF']) == 'edit_pegawai.php')
    ),
);
?>

<!-- Sidebar Menu -->
<aside class="sidebar">
    <nav class="main-menu">
        <ul>
            <?php foreach($menu_items as $item): ?>
            <li>
                <a href="<?php echo $item['link']; ?>" class="<?php echo $item['active'] ? 'active' : ''; ?>">
                    <i class="<?php echo $item['icon']; ?>"></i>
                    <span><?php echo $item['title']; ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <a href="login.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span>
        </a>
    </div>
</aside>
