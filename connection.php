<?php
$conn = mysqli_connect("localhost", "root", "", "data");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
