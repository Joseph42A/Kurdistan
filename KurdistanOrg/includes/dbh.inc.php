<?php
$conn = mysqli_connect("localhost", "root", "", "kurdistan");
if (!$conn) {
    echo "Database Error: " . mysqli_connect_error();
}
