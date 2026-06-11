<?php
include '../koneksi.php';

if (isset($_POST['register'])) {
    $nama     = trim($_POST['nama']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Cek apakah email sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $sql = "INSERT INTO users (nama, email, password)
                VALUES ('$nama', '$email', '$password')";

        $simpan = mysqli_query($conn, $sql);

        if ($simpan) {
            header('Location: login.php');
            exit;
        } else {
            $error = "Gagal menyimpan data: " . mysqli_error($conn);
        }
    }
}

include '../partials/header.php';
?>

<style>
    /* CSS untuk memposisikan ke tengah */
    .wrapper-register {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 85vh; /* Sedikit lebih tinggi karena form lebih panjang */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-register {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .card-register h2 {
        margin-top: 0;
        color: #333;
        margin-bottom: 25px;
    }

    .card-register input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
    }

    .card-register button {
        width: 100%;
        padding: 12px;
        background-color: #007bff; /* Biru untuk register */
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        margin-top: 15px;
        transition: 0.3s;
    }

    .card-register button:hover {
        background-color: #0056b3;
    }

    .error-text {
        color: #d9534f;
        background: #fdf7f7;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 15px;
        border: 1px solid #ebccd1;
    }

    .login-link {
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }

    .login-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }
</style>

<div class="wrapper-register">
    <div class="card-register">
        <h2>Register User</h2>

        <?php if (isset($error)) : ?>
            <div class="error-text"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Daftar Sekarang</button>
        </form>

        <p class="login-link">
            Sudah punya akun?
            <a href="login.php">Login di sini</a>
        </p>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
