<?php

session_start();

setcookie('userId', 1000, time() - 3600, "/", "", false, true);
setcookie('token', 1000, time() - 3600, "/", "", false, true);
session_destroy();
setcookie('PHPSESSID', 1000, time() - 3600, "/", "", false, true);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-5">
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                </svg></div>
            <div>
                <p class="font-bold">Logout</p>
                <p class="text-sm">Logout berhasil.</p>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="..">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</body>