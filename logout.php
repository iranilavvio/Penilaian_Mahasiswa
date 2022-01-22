<?php
session_start();

// untuk mengosongkan $_session[]
$_SESSION = [];

// untuk menghapus session
session_unset();

// untuk menghentikan session
session_destroy();

// menghilangkan cookie
setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

header("location: login.php");
exit;
