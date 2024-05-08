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
    $nama = $_POST['nama'];

    $stmt = $pdo->prepare("INSERT INTO mahasiswa (nim, nama) VALUES (:nim, :nama);");
    $stmt->execute(['nim' => $nim, 'nama' => $nama]);

    $lastInsertedId = $pdo->lastInsertId();
  }

  ?>

  <div class="w-full max-w-xs m-auto">
    <?php if (isset($lastInsertedId)) { ?>
      <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
            </svg></div>
          <div>
            <p class="font-bold">Tambah Mahasiswa</p>
            <p class="text-sm">Tambah mahasiswa berhasil.</p>
          </div>
        </div>
      </div>
    <?php } ?>

    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action=".">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="nim">
          NIM
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nim" name="nim" type="text" placeholder="Masukkan NIM">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
          Nama
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan Nama">
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
  </div>
</body>

</html>