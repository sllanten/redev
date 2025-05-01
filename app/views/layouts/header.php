<?php
dd("header");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["cod"];
    header("Location: " . "http://devsllanten.com/");
    exit;
}
