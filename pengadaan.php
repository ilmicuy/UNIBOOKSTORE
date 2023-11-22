<?php
require_once("connection.php");
session_start();

$sql = "SELECT books.book_id, books.kategori, books.nama_buku, books.harga, books.stok, authors.nama
        FROM books
        JOIN authors ON books.fk_author_id = authors.author_id
        ORDER BY books.stok ASC";

$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuyz Books Store - Pengadaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">

<body>
    <header>
        <!-- Navbar -->
        <nav>
            <img src="./images/logo.svg" alt="logo" class="logo">
            <ul class="nav__list">
                <li class="nav__item"><a class="text" href="index.php">Home</a></li>
                <li class="nav__item"><a class="text" href="admin.php">Admin</a></li>
                <li class="nav__item"><a class="text" href="#">Pengadaan</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h4>Data Buku</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-info">
                                <thead>
                                    <tr>
                                        <th class="text-center">Book ID</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Nama Buku</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Penerbit</th>
                                        <th class="text-center">Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query) {
                                        while ($books = mysqli_fetch_assoc($query)) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $books['book_id']; ?></td>
                                                <td><?= $books['kategori']; ?></td>
                                                <td><?= $books['nama_buku']; ?></td>
                                                <td><?= $books['harga']; ?></td>
                                                <td class="text-center"><?= $books['stok']; ?></td>
                                                <td><?= $books['nama']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($books['stok'] < 10) {
                                                        echo "<h6 class='text-center text-danger'>Buku harus segera di restock!</h6>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<h5 class="text-center">Tidak ada data!</h5>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>Cuyz Book Store &#169; 2023, by Muhammad Nur Ilmi</p>
    </footer>
</body>

</html>