<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tugas 1: OOP PHP</title>
</head>
<body>
    <pre>
<?php
include 'Kendaraan/Mobil.php';

use Kendaraan\Mobil;

$mobil = new Mobil("HONDA", 2019);
$mobil->info();
$mobil->deskripsi();
?>
    </pre>
</body>
</html>
