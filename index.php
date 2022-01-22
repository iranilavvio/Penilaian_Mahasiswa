<?php
session_start();

// mengecek apakah sudah login
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
	<link rel="stylesheet" href="assets/fontawesome/css/fontawesome.min.css">

    <title>Penilaian Mahasiswa</title>
    <script src="assets/js/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    require 'functions.php';

    $mahasiswa = query("SELECT * FROM mahasiswa");

    if (isset($_POST['cari'])) {
        $mahasiswa = carimhs($_POST['keyword']);
    }
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: aliceblue;">
        <div class="container-fluid mx-3">
            <a class="navbar-brand" href="index.php">
                <span class="font-weight-bold">Aplikasi Penilaian Mahasiswa</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <div class="ml-auto">
                    <img src="assets/img/<?= $_SESSION['foto']; ?>" alt="Admin Foto" class="rounded-circle" width="50px">
                    <span class="font-weight-bold text-capitalize"><?= $_SESSION['username']; ?></span>
                </div>
                <a href="logout.php" class="logout ml-4 btn btn-secondary tombol-logout">
                    <img src="assets/img/box-arrow-right.svg" width="24px" alt="">
                </a>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-3">
                <h3 class="header">Daftar Mahasiswa</h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <!-- Button trigger modal -->
                <a class="btn btn-info  tombolTambahData" data-toggle="modal" data-target="#formModal">
                 Create New
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <form action="" method="post" class="form-cari">
                    <div class="input-group">
                        <input type="text" name="keyword" id="keyword" class="form-control" autocomplete="off" placeholder="masukkan keyword pencarian...">
                        <button type="submit" name="cari" id="tombol-cari" class="btn btn-secondary">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-3 mb-5">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover align-middle text-center pb-5 mb-5">
                    <thead>
                        <tr style="background-color: thistle;">
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>PROGRAM STUDI</th>
                            <th>NOMOR HANDPHONE</th>
                            <th class="aksi">AKSI</th>
                        </tr>
                    </thead>
                    <tr>
                        <?php if (count($mahasiswa) > 0) : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($mahasiswa as $mhs) : ?>
                    <tr>
                        <td>
                            <?= $i++; ?>
                        </td>
                        <td>
                            <?= $mhs['nim']; ?>
                        </td>
                        <td>
                            <?= $mhs['nama']; ?>
                        </td>
                        <td>
                            <?= $mhs['program_studi']; ?>
                        </td>
                        <td>
                            <?= $mhs['no_hp']; ?>
                        </td>
                        <td class="aksi">
                            <div class="btn-group">
                                <a href="detail.php?nim=<?= $mhs["nim"] ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                                <a type="button" class="btn btn-sm btn-outline-success tombolUbahData" data-toggle="modal" data-target="#formModal" data-id="<?= $mhs['id']; ?>" data-nim="<?= $mhs['nim']; ?>" data-nama="<?= $mhs['nama']; ?>" data-program_studi="<?= $mhs['program_studi']; ?>" data-no_hp="<?= $mhs['no_hp']; ?>">
                                    Ubah
                                </a>
                                <a href="hapus_mhs.php?id=<?= $mhs["id"] ?>" class="btn btn-sm btn-outline-danger tombol-hapus">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan=6 class='text-center'> Data tidak ada</td>
                </tr>
            <?php endif; ?>
            </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="tambah_mhs.php" method="post">
                        <input type="hidden" name="id" id="id">

                        <div class="ml-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-group row">
                                        <div class="col-md-3">
                                            <label for="nim" class="col-form-label">Nim</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="nim" name="nim" required minlength="8" maxlength="8">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-group row">
                                        <div class="col-md-3">
                                            <label for="nama" class="col-form-label">Nama</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="nama" name="nama" required maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-group row">
                                        <div class="col-md-3">
                                            <label for="program_studi" class="col-form-label">Program Studi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="program_studi" name="program_studi" required maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-group row">
                                        <div class="col-md-3">
                                            <label for="no_hp" class="col-form-label">Nomor Handphone</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" required pattern="\d*" minlength="11" maxlength="13">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>