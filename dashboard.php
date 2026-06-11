<?php
include '../koneksi.php';
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include '../partials/header.php';
?>

<h2>Dashboard Admin</h2>
<p>Selamat datang, <?= $_SESSION['admin']['nama_admin']; ?></p>
<a href="kos.php">Kelola Data Kos</a> |
<a href="../logout.php">Logout</a>

<?php include '../partials/footer.php'; ?>
