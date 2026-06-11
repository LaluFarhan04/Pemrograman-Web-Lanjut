<?php
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_kos'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $fasilitas = $_POST['fasilitas'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $kontak = $_POST['kontak'];

    mysqli_query($conn, "INSERT INTO kos
        (nama_kos, alamat, harga, fasilitas, deskripsi, status, kontak)
        VALUES
        ('$nama','$alamat','$harga','$fasilitas','$deskripsi','$status','$kontak')");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kos WHERE id_kos='$id'");
}

$data = mysqli_query($conn, "SELECT * FROM kos ORDER BY id_kos DESC");
include '../partials/header.php';
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="../assets/jquery.dataTables.min.css">

<h2>Kelola Data Kos</h2>
<a href="dashboard.php">Kembali</a>

<h3>Tambah Kos</h3>
<form method="POST">
    <input type="text" name="nama_kos" placeholder="Nama Kos" required>
    <textarea name="alamat" placeholder="Alamat"></textarea>
    <input type="number" name="harga" placeholder="Harga">
    <textarea name="fasilitas" placeholder="Fasilitas"></textarea>
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>

    <select name="status">
        <option value="Tersedia">Tersedia</option>
        <option value="Penuh">Penuh</option>
    </select>

    <input type="text" name="kontak" placeholder="Kontak">
    <button type="submit" name="tambah">Simpan</button>
</form>

<h3>Daftar Kos</h3>
<table id="tabelKos">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kos</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_kos']; ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <a href="?hapus=<?= $row['id_kos']; ?>"
                   onclick="return confirm('Hapus data?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- jQuery -->
<script src="../assets/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="../assets/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#tabelKos').DataTable();
});
</script>

<?php include '../partials/footer.php'; ?>
