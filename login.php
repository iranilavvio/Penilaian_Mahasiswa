<?php
// untuk memulai session harus menuliskan session_start();
session_start();
require 'functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM admin WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

// jika sudah login maka akan dipindahkan ke index.php
if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    // cek username
    // mysqli_num_rows -> menampilkan jumlah rows/data dari sql yang diminta
    if (mysqli_num_rows($result) === 1) {
        // mengambil query sql menjadi variabel array
        $row = mysqli_fetch_assoc($result);

        $foto = $row['foto'];

        // cek password
        if (password_verify($password, $row['password'])) {
            // session login
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["foto"] = $foto;

            header("location: index.php");
            exit;
        }
    }

    // username atau password salah
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <script src="assets/js/sweetalert2.all.min.js"></script>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-transparent mb-0">
                        <h2 class="font-weight-bold text-center">Login Page</h2><br>
                        <h5 class="font-weight-bold text-center">Penilaian Mahasiswa</h5>
                    </div>
                    <div class="card-body">
                        <!-- peringatan salah input username atau password -->
                        <?php if (isset($error)) : ?>
                            <script>
                                Swal.fire({
                                    title: 'Inputan Username atau Password salah',
                                    text: 'silahkan periksa inputan kembali',
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    if (result.value) {
                                        document.location.href = 'login.php';
                                    }
                                })
                            </script>
                        <?php endif ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>