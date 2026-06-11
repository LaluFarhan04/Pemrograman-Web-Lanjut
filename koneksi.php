<?php
session_start();

$conn = mysqli_connect(
    "localhost",
    "tiuinmtr_spotkos",
    "spotkos12345#",
    "tiuinmtr_spot_kos"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
