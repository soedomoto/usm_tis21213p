<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-5">
  <?php

  /**
   * File ini berisi kode untuk menampilkan list mahasiswa 
   * 1. Koneksi ke database
   * 2. Query ke database
   * 3. Render hasil sebagai tabel
   */

  include_once("./include/connection.php");

  $stmt = $pdo->prepare("SELECT * FROM mahasiswa");
  $stmt->execute();
  $rows = $stmt->fetchAll();

  ?>

  <div>
    <div class="mb-2">
      <a href="./tambah" aria-label="Tambah Mahasiswa" class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white">
        Tambah
      </a>
    </div>
    <table class="w-full table-auto shadow-lg bg-white">
      <thead>
        <tr>
          <td class="bg-blue-100 border text-left px-8 py-4">NIM</td>
          <td class="bg-blue-100 border text-left px-8 py-4">Nama</td>
          <td class="bg-blue-100 border text-left px-8 py-4">Aksi</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r) { ?>
          <tr>
            <td class="border px-8 py-4"><?php echo $r['nim']; ?></td>
            <td class="border px-8 py-4"><?php echo $r['nama']; ?></td>
            <td class="border px-8 py-4">
              <a href="./ubah?nim=<?php echo $r['nim']; ?>" class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white">
                Edit
              </a>
              <a href="./hapus?nim=<?php echo $r['nim']; ?>" class="bg-red-500 hover:bg-red-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white">
                Hapus
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>