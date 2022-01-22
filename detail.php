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
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

    <title>Penilaian Mahasiswa</title>
    <script src="assets/js/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    require 'functions.php';

    $nim_mhs = $_GET['nim'];

    $mahasiswa = selectMhsByNim($nim_mhs);

    $nilai = selectNilaiByNim($nim_mhs);

    if (isset($_POST['cari'])) {
        $nilai = carinilai($_POST['keyword']);
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
            <div class="col-md-3 mb-3">
                <a href="index.php" class="btn btn-outline-secondary">
                    Back
                </a>
            </div>
    </div></div>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card border-info mb-3">
                    <div class="card-header">
                        <h5 class="card-title"><b>Detail Mahasiswa</b></h3>
                    </div>
                <table class="table table-borderless">
                    <tr>
                        <th>NIM</th>
                        <td><?= $mahasiswa['nim']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><?= $mahasiswa['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td><?= $mahasiswa['program_studi']; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Hanphone</th>
                        <td><?= $mahasiswa['no_hp']; ?></td>
                    </tr>
                </table>
                </div>
            </div>
        </div><br>

        <div class="row mt-3">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info  tombolTambahDataNilai" data-toggle="modal" data-target="#formModal">
                    Tambah Nilai
                </button>
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
            <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title"><b>Nilai Mahasiswa</b></h3>
                    </div>
                <table class="table table-striped table-hover align-middle text-center pb-5 mb-5">
                    <thead>
                        <tr style="background-color: thistle;">
                            <th>NO</th>
                            <th>MATA KULIAH</th>
                            <th>NILAI</th>
                            <th>GRADE</th>
                            <th class="aksi">AKSI</th>
                        </tr>
                    </thead>
                    <tr>
                        <?php if (count($nilai) > 0) : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($nilai as $nl) : ?>
                    <tr>
                        <td>
                            <?= $i++; ?>
                        </td>
                        <td>
                            <?= $nl['mata_kuliah']; ?>
                        </td>
                        <td>
                            <?= $nl['nilai']; ?>
                        </td>
                        <td>
                            <?= $nl['grade']; ?>
                        </td>
                        <td class="aksi">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-success tombolUbahDataNilai" data-toggle="modal" data-target="#formModal" data-id="<?= $nl['id']; ?>" data-nim="<?= $nl['nim']; ?>" data-mata_kuliah="<?= $nl['mata_kuliah']; ?>" data-nilai="<?= $nl['nilai']; ?>" data-grade="<?= $nl['grade']; ?>">
                                    Ubah
                                </button>
                                <a href="hapus_nilai.php?id=<?= $nl["id"] ?>" class="btn btn-sm btn-outline-danger tombol-hapus-nilai">Hapus</a>
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
    </div>


    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="tambah_nilai.php" method="post">
                        <input type="hidden" name="id" id="id">

                        <div class="ml-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-group row">
                                        <div class="col-md-3">
                                            <label for="nim" class="col-form-label">Nim</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="nim" name="nim" required readonly value="<?= $nim_mhs; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-group row">
                                        <div class="col-md-3">
                                            <label for="mata_kuliah" class="col-form-label">Mata Kuliah</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" required maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 form-group row">
                                        <div class="col-md-3">
                                            <label for="nilai" class="col-form-label">Nilai</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" id="nilai" name="nilai" required min="0" max="100">
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