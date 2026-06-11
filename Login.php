<?php
include '../koneksi.php';

// Pastikan session dimulai jika belum ada di header
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users 
                                  WHERE email='$email' 
                                  AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['user'] = $data;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}

include '../partials/header.php';
?>

<style>
    .wrapper-login {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-login {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 380px;
        text-align: center;
    }

    .card-login h2 {
        margin-top: 0;
        color: #333;
        margin-bottom: 20px;
    }

    .card-login input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box; 
    }


    .card-login button {
        width: 100%;
        padding: 12px;
        background-color: #007bff; /* Biru */
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        margin-top: 10px;
        transition: 0.3s;
    }

    .card-login button:hover {
        background-color: #0056b3; /* Biru lebih gelap saat hover */
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

    .reg-link {
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }


    .reg-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .reg-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="wrapper-login">
    <div class="card-login">
        <h2>Login User</h2>

        <?php if (isset($error)) : ?>
            <div class="error-text"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input
                type="email"
                name="email"
                placeholder="Masukkan Email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Masukkan Password"
                required
            >

            <button type="submit" name="login">
                Login
            </button>
        </form>

        <p class="reg-link">
            Belum punya akun?
            <a href="register.php">Daftar di sini</a>
        </p>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
