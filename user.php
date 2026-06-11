<?php
include '../koneksi.php';
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM users");
include '../partials/header.php';
?>

<h2>Data User</h2>
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
    </tr>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['email']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../partials/footer.php'; ?> 
