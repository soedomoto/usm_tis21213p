<?php

require("../vendor/autoload.php");
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

    include_once("../include/connection.php");

    if ($_POST) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM pengguna WHERE email = :email AND password = :password;");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $row = $stmt->fetch();

        if (!!$row) {
            // Alternative 1. Set raw cookie
            setcookie("userId", $row["email"], 0, "/", "", false, true);

            // Alternative 2. Create token, set to cookie
            $userId = $row["email"];
            $secret = 'sec!ReT423*&';
            $expiration = time() + 3600;
            $issuer = 'localhost';

            $token = Token::create($userId, $secret, $expiration, $issuer);
            setcookie("token", $token, 0, "/", "", false, true);

            // Alternative 3. Session
            $_SESSION["user"] = $row;
            $_SESSION["userId"] = $row["email"];
            $_SESSION["token"] = $token;
        }
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Masukkan Email">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="text" placeholder="Masukkan Password">
            </div>
            <div class="flex items-center justify-between">
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="..">
                    Kembali
                </a>
                <button class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white" type="submit">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>

</html>