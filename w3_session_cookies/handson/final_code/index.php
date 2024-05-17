<?php

require("./vendor/autoload.php");

use ReallySimpleJWT\Token;

session_start();

?>

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

  // 1. Cek cookie and session
  $userId = isset($_COOKIE["userId"]) ? $_COOKIE["userId"] : "";
  $token = isset($_COOKIE["token"]) ? $_COOKIE["token"] : "";

  $secret = 'sec!ReT423*&';
  $isValidToken = Token::validate($token, $secret);
  $decodedToken = Token::getPayload($token);

  $sessUser = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

  $isAuthorized = $isValidToken && $decodedToken["user_id"] == "soedomoto@gmail.com";

  // print_r([
  //   '$userId' => $userId,
  //   '$token' => $token,
  //   '$isValidToken' => $isValidToken,
  //   '$decodedToken' => $decodedToken,
  //   '$sessUser' => $sessUser
  // ]);


  // 2. Pagination menggunakan session
  if (!isset($_SESSION["page"])) $_SESSION["page"] = 1;
  if (!isset($_SESSION["rowsPerPage"])) $_SESSION["rowsPerPage"] = 5;
  if (isset($_POST["page"])) $_SESSION["page"] = $_POST["page"];

  $page = $_SESSION["page"];
  $rowsPerPage = $_SESSION["rowsPerPage"];
  $offset = ($page - 1) * $rowsPerPage;
  $limit = $rowsPerPage;

  $stmt = $pdo->prepare("SELECT * FROM mahasiswa LIMIT :limit OFFSET :offset");
  $stmt->execute(['limit' => $limit, 'offset' => $offset]);
  $rows = $stmt->fetchAll();

  // Get total rows
  $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM mahasiswa");
  $stmt->execute();
  $trow = $stmt->fetch();
  $total = $trow['total'];

  ?>

  <div>
    <?php include_once("./include/header.php"); ?>
    <div class="mt-2 mb-2">
      <?php if ($isAuthorized) { ?>
        <a href="./tambah" aria-label="Tambah Mahasiswa" class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white">
          Tambah
        </a>
      <?php } ?>
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
              <?php if ($isAuthorized) { ?>
                <a href="./ubah?nim=<?php echo $r['nim']; ?>" class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white">
                  Edit
                </a>
                <a href="./hapus?nim=<?php echo $r['nim']; ?>" class="bg-red-500 hover:bg-red-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white">
                  Hapus
                </a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
      <div class="flex flex-1 justify-between sm:hidden">
        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            Showing
            <span class="font-medium"><?php echo $offset + 1; ?></span>
            to
            <span class="font-medium"><?php echo $offset + $limit; ?></span>
            of
            <span class="font-medium"><?php echo $total; ?></span>
            results
          </p>
        </div>
        <div>
          <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            <form method="POST" action=".">
              <input type="hidden" name="page" value="<?php echo ($page - 1); ?>" />
              <button <?php echo ($page == 1) ? 'disabled="disabled"' : ""; ?> type="submit" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:bg-gray-200 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Previous</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                </svg>
              </button>
            </form>
            <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
            <!-- <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>
            <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">3</a>
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
            <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">8</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">9</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">10</a> -->
            <form method="POST" action=".">
              <input type="hidden" name="page" value="<?php echo ($page + 1); ?>" />
              <button type="submit" <?php echo ($offset + $limit) >= $total ? 'disabled="disabled"' : ''; ?> class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:bg-gray-200 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Next</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                </svg>
              </button>
            </form>
          </nav>
        </div>
      </div>
    </div>

  </div>
</body>

</html>