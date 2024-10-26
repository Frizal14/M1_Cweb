<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Segitiga Sama Sisi</title>
</head>
<body>
    <pre>
<?php
$rows = 5; // Define the number of rows

for ($i = 1; $i <= $rows; $i++) {
    // Print spaces
    for ($j = $i; $j < $rows; $j++) {
        echo " ";
    }
    // Print asterisks
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "\n"; // New line after each row
}
?>
    </pre>
</body>
</html>
