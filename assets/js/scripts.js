// Index
$(function () {
    $('.tombolTambahData').on('click', function () {
        $('#formModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-body form').attr('action', 'tambah_mhs.php');
        $('.modal-footer button[type=submit]').html('Tambah Data');


        $('.modal-body #nim').prop('readonly', false);
        $('#nim').val('');
        $('#nama').val('');
        $('#program_studi').val('');
        $('#no_hp').val('');
    })
});

$('.tombolUbahData').on('click', function () {
    $('#formModalLabel').html('Ubah Data Mahasiswa');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'ubah_mhs.php');

    let id = $(this).data('id');
    let nim = $(this).data('nim');
    let nama = $(this).data('nama');
    let program_studi = $(this).data('program_studi');
    let no_hp = $(this).data('no_hp');

    $('.modal-body #id').val(id);
    $('.modal-body #nim').val(nim);
    $('.modal-body #nim').prop('readonly', true);
    $('.modal-body #nama').val(nama);
    $('.modal-body #program_studi').val(program_studi);
    $('.modal-body #no_hp').val(no_hp);
});

$('#liveToastBtn').on('click', function () {
    $('.toast').show();
});

// tombol hapus
$('.tombol-hapus').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "data mahasiswa akan dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});

// Detail
$(function () {
    $('.tombolTambahDataNilai').on('click', function () {
        $('#formModalLabel').html('Tambah Data Nilai');
        $('.modal-body form').attr('action', 'tambah_nilai.php');
        $('.modal-footer button[type=submit]').html('Tambah Data');


        $('#mata_kuliah').val('');
        $('#nilai').val('');
    })
});

$('.tombolUbahDataNilai').on('click', function () {
    $('#formModalLabel').html('Ubah Data Nilai');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'ubah_nilai.php');

    let id = $(this).data('id');
    let nim = $(this).data('nim');
    let mata_kuliah = $(this).data('mata_kuliah');
    let nilai = $(this).data('nilai');

    $('.modal-body #id').val(id);
    $('.modal-body #nim').val(nim);
    $('.modal-body #nim').prop('readonly', true);
    $('.modal-body #mata_kuliah').val(mata_kuliah);
    $('.modal-body #nilai').val(nilai);
});

$('.tombol-hapus-nilai').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "data nilai akan dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});

// tombol logout
$('.tombol-logout').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "ingin keluar dari aplikasi",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});