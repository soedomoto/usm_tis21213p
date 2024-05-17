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
    $nim = $_GET['nim'];
    $nama = $_POST['nama'];

    $stmt = $pdo->prepare("UPDATE mahasiswa SET nama = :nama WHERE nim = :nim;");
    $isUpdated = $stmt->execute(['nim' => $nim, 'nama' => $nama]);
  }

  if (isset($_GET['nim'])) {
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
    $stmt->execute(['nim' => $_GET['nim']]);
    $row = $stmt->fetch();
  }

  ?>

  <div class="w-full max-w-xs m-auto">
    <?php if (isset($isUpdated) && $isUpdated == true) { ?>
      <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
            </svg></div>
          <div>
            <p class="font-bold">Ubah Mahasiswa</p>
            <p class="text-sm">Ubah mahasiswa berhasil.</p>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if (isset($row)) { ?>
      <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="./?nim=<?php echo $_GET['nim']; ?>">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="nim">
            NIM
          </label>
          <input disabled class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nim" type="text" placeholder="Masukkan NIM" value="<?php echo $row['nim']; ?>">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
            Nama
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan Nama" value="<?php echo $row['nama']; ?>">
        </div>
        <div class="flex items-center justify-between">
          <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="..">
            Kembali
          </a>
          <button class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white" type="submit">
            Simpan
          </button>
        </div>
      </form>
    <?php } ?>
  </div>
</body>

</html>