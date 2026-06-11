<?php
include '../koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM kos");
include '../partials/header.php';
?>

<link rel="stylesheet" href="../assets/jquery.dataTables.min.css">

<h2>Daftar Kos</h2>

<table id="tabelKos">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kos</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Detail</th>
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
                <a href="detail.php?id=<?= $row['id_kos']; ?>">Lihat</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script src="../assets/jquery-3.7.0.min.js"></script>
<script src="../assets/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#tabelKos').DataTable();
});
</script>

<?php include '../partials/footer.php'; ?>
