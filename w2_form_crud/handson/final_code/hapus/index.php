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
   * File ini berisi kode untuk menambahkan mahasiswa 
   * 1. Koneksi ke database
   * 2. Isi form
   * 3. Simpan
   */

  include_once("../include/connection.php");

  if ($_POST) {
    $nim = $_POST['nim'];
    $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE nim = :nim;");
    $isDeleted = $stmt->execute(['nim' => $nim]);
  }

  if (isset($_GET['nim'])) {
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
    $stmt->execute(['nim' => $_GET['nim']]);
    $row = $stmt->fetch();
  }

  ?>

  <div class="w-full max-w-xs m-auto">
    <?php if (isset($isDeleted) && $isDeleted == true) { ?>
      <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
            </svg></div>
          <div>
            <p class="font-bold">Hapus Mahasiswa</p>
            <p class="text-sm">Hapus mahasiswa berhasil.</p>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="..">
              Kembali
            </a>
          </div>
        </div>
      </div>
    <?php }  ?>

    <?php if (isset($row)) { ?>
      <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
            </svg></div>
          <div>
            <p class="font-bold">Konfirmasi</p>
            <p class="text-sm">Apakah Anda yakin akan menghapus [<?php echo $row['nim']; ?>] <?php echo $row['nama']; ?> ?</p>
          </div>
        </div>
      </div>

      <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="./">
        <input name="nim" type="hidden" value="<?php echo $row['nim']; ?>">
        <div class="flex items-center justify-between">
          <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="..">
            Batal
          </a>
          <button class="bg-red-500 hover:bg-red-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white" type="submit">
            Ya, Hapus
          </button>
        </div>
      </form>
    <?php } ?>
  </div>
</body>

</html>