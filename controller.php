<?php
session_start();
require_once("connection.php");

// Book Function
if (isset($_POST['delete_book'])) {
    $book_id = mysqli_real_escape_string($conn, $_POST['delete_book']);

    $sql = "DELETE FROM books WHERE book_id='$book_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['message'] = 'Delete book success!';
        header('Location: admin.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Delete book failed!';
        header('Location: admin.php');
        exit(0);
    }
}


if (isset($_POST['update_book'])) {
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $nama_buku = mysqli_real_escape_string($conn, $_POST['nama_buku']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $authors_id = mysqli_real_escape_string($conn, $_POST['author']);

    $sql = "UPDATE books SET kategori='$kategori', nama_buku='$nama_buku', harga='$harga', stok='$stok', fk_author_id='$authors_id' WHERE book_id='$book_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['message'] = 'Update book success!';
        header('Location: admin.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Update book failed! Error: ' . mysqli_error($conn);
        header('Location: admin.php');
        exit(0);
    }
}

if (isset($_POST['add_book'])) {
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $nama_buku = mysqli_real_escape_string($conn, $_POST['nama_buku']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $authors_id = mysqli_real_escape_string($conn, $_POST['author']);

    $sql = "INSERT INTO books (book_id, kategori, nama_buku, harga, stok, fk_author_id) VALUES ('book_id', '$kategori', '$nama_buku', '$harga', '$stok', '$authors_id')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['message'] = 'Add book success!';
        header('Location: admin.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Add book failed!';
        header('Location: admin.php');
        exit(0);
    }
}

// Author Function
if (isset($_POST['delete_author'])) {
    $author_id = mysqli_real_escape_string($conn, $_POST['delete_author']);

    $sql = "DELETE FROM authors WHERE author_id='$author_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['message'] = 'Delete author success!';
        header('Location: admin.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Delete author failed!';
        header('Location: admin.php');
        exit(0);
    }
}


if (isset($_POST['update_author'])) {
    $author_id = mysqli_real_escape_string($conn, $_POST['author_id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $kota = mysqli_real_escape_string($conn, $_POST['kota']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

    $sql = "UPDATE authors SET nama='$nama', alamat='$alamat', kota='$kota', telepon='$telepon' WHERE author_id='$author_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['message'] = 'Update author success!';
        header('Location: admin.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Update author failed!';
        header('Location: admin.php');
        exit(0);
    }
}


if (isset($_POST['add_author'])) {
    $author_id = mysqli_real_escape_string($conn, $_POST['author_id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $kota = mysqli_real_escape_string($conn, $_POST['kota']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

    $sql = "INSERT INTO authors (author_id, nama, alamat, kota, telepon) VALUES ('author_id', '$nama', '$alamat', '$kota', '$telepon')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['message'] = 'Add author success!';
        header('Location: admin.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Add author failed!';
        header('Location: admin.php');
        exit(0);
    }
}
