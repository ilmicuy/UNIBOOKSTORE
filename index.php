<?php
require_once("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuyz Book Store - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <header>
        <!-- Navbar -->
        <nav>
            <img src="./images/logo.svg" alt="logo" class="logo">
            <ul class="nav__list">
                <li class="nav__item"><a class="text" href="#">Home</a></li>
                <li class="nav__item"><a class="text" href="admin.php">Admin</a></li>
                <li class="nav__item"><a class="text" href="pengadaan.php">Pengadaan</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="navbar card-header">
                            <div class="container-fluid">
                                <h1 class="fs-2">Data Buku</h1>
                                <?php
                                $search = isset($_GET['search']) ? $_GET['search'] : '';
                                $sql = "SELECT * FROM books JOIN authors ON books.fk_author_id = authors.author_id WHERE nama_buku LIKE '%$search%'";
                                $query = mysqli_query($conn, $sql);
                                ?>
                                <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search" name="search" value="<?= $search ?>">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (mysqli_num_rows($query) > 0) {
                                        foreach ($query as $books) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $books['book_id']; ?></td>
                                                <td><?= $books['kategori']; ?></td>
                                                <td><?= $books['nama_buku']; ?></td>
                                                <td><?= $books['harga']; ?></td>
                                                <td class="text-center"><?= $books['stok']; ?></td>
                                                <td><?= $books['nama']; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<h5 class="text-center">Tidak ada data!</h5>';
                                    } ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>