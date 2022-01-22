<?php
// session_start();

// // mengecek apakah sudah login
// if (!isset($_SESSION["login"])) {
//     header("location: login.php");
//     exit;
// } else if (!isset($_POST['submit'])) {
//     header("location: index.php");
//     exit;
// }

require 'functions.php';

// $id = $_POST['id'];
// $brg = query("SELECT * FROM buku WHERE id = $id")[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>
</head>

<body>

    <script src="assets/js/sweetalert2.all.min.js"></script>

    <?php
    if (isset($_POST['submit'])) {
        if (ubahnilai($_POST) > 0) {
            echo "  
                    <script>
                        Swal.fire({
                            title: 'Data Nilai',
                            text: 'Berhasil di Ubah',
                            icon: 'success',
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            if (result.value) {
                            document.location.href = 'index.php';
                            }else{
                                document.location.href = 'index.php';
                            }
                        })
                    </script>
                ";
        } else {
            echo "  
                    <script>
                        Swal.fire({
                            title: 'Data Nilai',
                            text: 'Gagal di Ubah',
                            icon: 'error',
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            if (result.value) {
                            document.location.href = 'index.php';
                            }else{
                                document.location.href = 'index.php';
                            }
                        })
                    </script>
                ";
        }
    }
    ?>

</body>

</html>