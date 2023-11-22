<?php
require_once("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuyz Book Store - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
  <?php include('message.php'); ?>
  <header>
    <!-- Navbar -->
    <nav>
      <img src="./images/logo.svg" alt="logo" class="logo">
      <ul class="nav__list">
        <li class="nav__item"><a class="text" href="index.php">Home</a></li>
        <li class="nav__item"><a class="text" href="#">Admin</a></li>
        <li class="nav__item"><a class="text" href="pengadaan.php">Pengadaan</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <!-- Add Book Modal -->
    <div class="example-modal">
      <div id="addbookmodal" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Tambah Buku</h3>
            </div>
            <div class="modal-body">
              <form action="controller.php" method="POST" role="form">
                <div class="form-group mb-2">
                  <div class="row">
                    <label for="kategori" class="col-sm-3 control-label text-right">Kategori</label>
                    <div class="col-sm-8"><input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori Buku" required></div>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <div class="row">
                    <label for="nama_buku" class="col-sm-3 control-label text-right">Nama Buku</label>
                    <div class="col-sm-8"><input type="text" class="form-control" id="nama_buku" placeholder="Masukan Nama Buku" name="nama_buku" required></div>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <div class="row">
                    <label for="harga" class="col-sm-3 control-label text-right">Harga</label>
                    <div class="col-sm-8"><input type="number" min="1" class="form-control" id="harga" placeholder="Masukan Harga Buku" name="harga" required></div>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <div class="row">
                    <label for="stok" class="col-sm-3 control-label text-right">Stok</label>
                    <div class="col-sm-8"><input type="number" min="1" class="form-control" id="stok" placeholder="Masukan Stok Buku" name="stok" required></div>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <div class="row">
                    <label for="penerbit" class="col-sm-3 control-label text-right">Penerbit</label>
                    <div class="col-sm-8">
                      <select name="author" class="form-control">
                        <?php
                        $sql = "SELECT * FROM authors";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                          foreach ($query as $authors) {
                        ?>
                            <option value="<?= $authors['author_id']; ?>"><?= $authors['nama']; ?></option>
                        <?php
                          }
                        } else {
                          echo '<h5 class="text-center">Tidak ada data!</h5>';
                        } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="nosave" type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="add_book" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Book Modal -->
      <div class="example-modal">
        <?php
        $book_id = isset($_GET['book_id']) ? $_GET['book_id'] : null;
        $sql = "SELECT * FROM books WHERE book_id='$book_id'";
        $query = mysqli_query($conn, $sql);
        $books = mysqli_fetch_assoc($query);
        $sql2 = "SELECT * FROM authors";
        $query2 = mysqli_query($conn, $sql2);
        ?>
        <div id="updatebookmodal" class="modal fade" role="dialog" style="display:none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Edit Buku</h3>
              </div>
              <div class="modal-body">
                <form action="controller.php" method="POST" role="form">

                  <input type="hidden" name="book_id" value="<?= $books['book_id'] ?? ''; ?>">
                  <div class="form-group mb-2">
                    <div class="row">
                      <label for="kategori" class="col-sm-3 control-label text-right">Kategori</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori Buku" value="<?= $books['kategori'] ?? ''; ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label for="nama_buku" class="col-sm-3 control-label text-right">Nama Buku</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_buku" placeholder="Masukan Nama Buku" name="nama_buku" value="<?= $books['nama_buku'] ?? ''; ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label for="harga" class="col-sm-3 control-label text-right">Harga</label>
                      <div class="col-sm-8"><input type="number" min="1" class="form-control" id="harga" placeholder="Masukan Harga Buku" name="harga" value="<?= $books['harga']; ?>" required></div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label for="stok" class="col-sm-3 control-label text-right">Stok</label>
                      <div class="col-sm-8"><input type="number" min="1" class="form-control" id="stok" placeholder="Masukan Stok Buku" name="stok" value="<?= $books['stok']; ?>" required></div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div class="row">
                      <label for="penerbit" class="col-sm-3 control-label text-right">Penerbit</label>
                      <div class="col-sm-8">
                        <select name="author" class="form-select">
                          <?php
                          foreach ($query2 as $authors) {
                          ?>
                            <?php
                            if ($authors['author_id'] == $books['fk_author_id']) {
                            ?>
                              <option value="<?= $authors['author_id'] ?>" selected><?= $authors['nama']; ?></option>
                            <?php

                            } else {
                            ?>
                              <option value="<?= $authors['author_id'] ?>"><?= $authors['nama'] ?></option>
                            <?php
                            }
                            ?>

                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button id="nosave" type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="update_book" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Book Table -->
        <div class="container mt-4">
          <div class="row">
            <div class="col-md-12">
              <div class="card custom-card">
                <div class="card-header d-flex justify-content-between">
                  <h4>Data Buku</h4>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbookmodal">Tambah Buku</button>
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
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM books JOIN authors ON books.fk_author_id = authors.author_id;";
                      $query = mysqli_query($conn, $sql);

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
                            <td class="d-flex justify-content-around text-center">
                              <button type="submit" name="update_book" value="<?= $books['book_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updatebookmodal">Edit
                              </button>
                              <form action="controller.php" method="POST" class="d-inline">
                                <button type="submit" name="delete_book" value="<?= $books['book_id']; ?>" class="btn btn-danger btn-sm">Delete
                                </button>
                              </form>
                            </td>
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
        <!-- Modal Author -->
        <div class="example-modal">
          <div id="addauthormodal" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title">Tambah Penerbit</h3>
                </div>
                <div class="modal-body">
                  <form action="controller.php" method="POST" role="form">
                    <div class="form-group mb-2">
                      <div class="row">
                        <label for="nama" class="col-sm-3 control-label text-right">Nama</label>
                        <div class="col-sm-8"><input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Penerbit" required></div>
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="row">
                        <label for="alamat" class="col-sm-3 control-label text-right">Alamat</label>
                        <div class="col-sm-8"><input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat Penerbit" name="alamat" required></div>
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="row">
                        <label for="kota" class="col-sm-3 control-label text-right">Kota</label>
                        <div class="col-sm-8"><input type="text" min="1" class="form-control" id="kota" placeholder="Masukan Kota Penerbit" name="kota" required></div>
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <div class="row">
                        <label for="telepon" class="col-sm-3 control-label text-right">Telepon</label>
                        <div class="col-sm-8"><input type="text" min="1" class="form-control" id="telepon" placeholder="Masukan Telepon Penerbit" name="telepon" required></div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" name="add_author" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Update Author Modal -->
          <div class="example-modal">
            <div id="updateauthormodal" class="modal fade" role="dialog" style="display:none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Edit Penerbit</h3>
                  </div>
                  <div class="modal-body">
                    <form action="controller.php" method="POST" role="form">
                      <?php
                      $author_id = isset($_GET['author_id']) ? $_GET['author_id'] : null;

                      if ($author_id !== null) {
                        $sql = "SELECT * FROM authors WHERE author_id='$author_id'";
                        $query = mysqli_query($conn, $sql);
                        $authors = mysqli_fetch_assoc($query);
                      }
                      ?>
                      <input type="hidden" name="author_id" value="<?= $authors['author_id'] ?? ''; ?>">
                      <div class="form-group mb-2">
                        <div class="row">
                          <label for="nama" class="col-sm-3 control-label text-right">Nama</label>
                          <div class="col-sm-8"><input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Penerbit" value="<?= $authors['nama'] ?? ''; ?>" required></div>
                        </div>
                      </div>
                      <div class="form-group mb-2">
                        <div class="row">
                          <label for="alamat" class="col-sm-3 control-label text-right">Alamat</label>
                          <div class="col-sm-8"><input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat Penerbit" name="alamat" value="<?= $authors['alamat'] ?? ''; ?>" required></div>
                        </div>
                      </div>
                      <div class="form-group mb-2">
                        <div class="row">
                          <label for="kota" class="col-sm-3 control-label text-right">Kota</label>
                          <div class="col-sm-8"><input type="text" min="1" class="form-control" id="kota" placeholder="Masukan Kota Penerbit" name="kota" value="<?= $authors['kota'] ?? ''; ?>" required></div>
                        </div>
                      </div>
                      <div class="form-group mb-2">
                        <div class="row">
                          <label for="telepon" class="col-sm-3 control-label text-right">Telepon</label>
                          <div class="col-sm-8"><input type="text" min="1" class="form-control" id="telepon" placeholder="Masukan Telepon Penerbit" name="telepon" value="<?= $authors['telepon'] ?? ''; ?>" required></div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button id="nosave" type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="update_author" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Author Table -->
          <div class="container mt-4">
            <div class="row">
              <div class="col-md-12">
                <div class="card custom-card">
                  <div class="card-header d-flex justify-content-between">
                    <h4>Data Penerbit</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addauthormodal">Tambah Penerbit</button>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped table-info">
                      <thead>
                        <tr>
                          <th class="text-center">Author ID</th>
                          <th class="text-center">Nama Penerbit</th>
                          <th class="text-center">Alamat</th>
                          <th class="text-center">Kota</th>
                          <th class="text-center">Telepon</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM authors";
                        $query = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($query) > 0) {
                          foreach ($query as $authors) {
                        ?>
                            <tr>
                              <td class="text-center"><?= $authors['author_id']; ?></td>
                              <td><?= $authors['nama']; ?></td>
                              <td><?= $authors['alamat']; ?></td>
                              <td><?= $authors['kota']; ?></td>
                              <td><?= $authors['telepon']; ?></td>
                              <td class="d-flex justify-content-around text-center">
                                <button type="submit" name="update_author" value="<?= $authors['author_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateauthormodal">Edit
                                </button>
                                <form action="controller.php" method="POST" class="d-inline">
                                  <button type="submit" name="delete_author" value="<?= $authors['author_id']; ?>" class="btn btn-danger btn-sm">Delete
                                  </button>
                                </form>
                              </td>
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
</body>

</html>