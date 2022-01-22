<?php
$conn = mysqli_connect("localhost", "root", "", "programming");

function query($query)
{
    global $conn;
    // meselect tabel dari database
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function selectMhsByNim($nim)
{
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");

    return mysqli_fetch_assoc($result);
}

function selectNilaiByNim($nim)
{
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM nilai WHERE nim = '$nim'");

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function tambahmhs($data)
{
    global $conn;

    $nim = input($data['nim']);
    $nama = input($data['nama']);
    $program_studi = input($data['program_studi']);
    $no_hp = input($data['no_hp']);

    // cek apakah nim sudah ada atau belum
    $result = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");

    if (mysqli_fetch_assoc($result)) {
        echo "
                <script>
                    alert('Kode mahasiswa sudah terdaftar');
                </script>
            ";

        return false;
    }

    $query = "INSERT INTO mahasiswa 
                    VALUES
                    ('', '$nim', '$nama', '$program_studi', '$no_hp')";

    global $conn;
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahnilai($data)
{
    global $conn;

    $nim = input($data['nim']);
    $mata_kuliah = input($data['mata_kuliah']);
    $nilai = input($data['nilai']);

    if ($nilai >= 85) {
        $grade = 'A';
    } elseif ($nilai >= 75) {
        $grade = 'B';
    } elseif ($nilai >= 65) {
        $grade = 'C';
    } elseif ($nilai >= 50) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    // cek matakuliah sudah ada atau belum
    $result = mysqli_query($conn, "SELECT mata_kuliah, nim FROM nilai WHERE nim = '$nim' AND mata_kuliah = '$mata_kuliah'");

    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('Mata Kuliah sudah terdaftar');
            </script>
        ";

        return false;
    }

    $query = "INSERT INTO nilai 
                    VALUES
                    ('', '$nim', '$mata_kuliah', '$nilai', '$grade')";

    global $conn;
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusmhs($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function hapusnilai($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM nilai WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubahmhs($data)
{
    $id = $data['id'];
    $nim = input($data['nim']);
    $nama = input($data['nama']);
    $program_studi = input($data['program_studi']);
    $no_hp = input($data['no_hp']);

    $query = "UPDATE mahasiswa SET 
                    nim = '$nim', 
                    nama = '$nama',
                    program_studi = '$program_studi',
                    no_hp = '$no_hp'
                WHERE id = $id
        ";

    global $conn;
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahnilai($data)
{
    $id = $data['id'];
    $nim = input($data['nim']);
    $mata_kuliah = input($data['mata_kuliah']);
    $nilai = input($data['nilai']);

    if ($nilai >= 85) {
        $grade = 'A';
    } elseif ($nilai >= 75) {
        $grade = 'B';
    } elseif ($nilai >= 65) {
        $grade = 'C';
    } elseif ($nilai >= 50) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    $query = "UPDATE nilai SET 
                    nim = '$nim', 
                    mata_kuliah = '$mata_kuliah',
                    nilai = '$nilai',
                    grade = '$grade'
                WHERE id = $id
        ";

    global $conn;
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function carimhs($keyword)
{
    $query = "SELECT * FROM mahasiswa
                    WHERE
                    nim LIKE '%$keyword%' OR
                    nama LIKE '%$keyword%' OR
                    program_studi LIKE '%$keyword%' OR
                    no_hp LIKE '%$keyword%'
                ";

    return query($query);
}

function carinilai($keyword)
{
    $query = "SELECT * FROM nilai
                    WHERE
                    mata_kuliah LIKE '%$keyword%' OR
                    nilai LIKE '%$keyword%' OR
                    grade LIKE '%$keyword%'
                ";

    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // cek apakah username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "
                <script>
                    alert('username sudah terdaftar');
                </script>
            ";

        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "
                <script>
                    alert('konfirmasi password tidak sesuai');
                </script>
            ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan username ke database
    $query = "INSERT INTO admin 
                    VALUES 
                    ('', '$username', '$password', 'foto')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
