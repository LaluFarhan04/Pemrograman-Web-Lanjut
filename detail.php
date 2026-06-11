<?php
include '../koneksi.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM kos WHERE id_kos='$id'");
$data = mysqli_fetch_assoc($query);

include '../partials/header.php';
?>

<h2><?= $data['nama_kos']; ?></h2>
<p><strong>Alamat:</strong> <?= $data['alamat']; ?></p>
<p><strong>Harga:</strong> Rp <?= number_format($data['harga']); ?></p>
<p><strong>Fasilitas:</strong> <?= nl2br($data['fasilitas']); ?></p>
<p><strong>Deskripsi:</strong> <?= nl2br($data['deskripsi']); ?></p>
<p><strong>Kontak:</strong> <?= $data['kontak']; ?></p>

<a href="dashboard.php">Kembali</a>

<?php include '../partials/footer.php'; ?>
