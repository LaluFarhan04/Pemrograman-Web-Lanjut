<?php
include '../koneksi.php';

// Pastikan session dimulai jika belum ada di header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Catatan: Sangat disarankan gunakan password_verify nantinya demi keamanan
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['admin'] = $data;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Email atau password salah!';
    }
}
?>

<?php include '../partials/header.php'; ?>

<style>
    body {
        margin: 0;
        background-color: #f0f2f5;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; /* Mengatur tinggi agar ke tengah layar */
    }

    .login-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
        width: 100%;
        max-width: 350px; /* Lebar maksimal kotak login */
    }

    .login-card h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-card input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box; /* Agar padding tidak merusak lebar */
    }

    .login-card button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .login-card button:hover {
        background-color: #0056b3;
    }

    .error-msg {
        color: red;
        font-size: 14px;
        margin-bottom: 15px;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h2>Login Admin</h2>
        
        <?php if (!empty($error)): ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login">Login</button>
        </form>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
