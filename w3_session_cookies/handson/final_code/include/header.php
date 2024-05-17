<?php

require("./vendor/autoload.php");

use ReallySimpleJWT\Token;

// 1. Cek cookie and session
$userId = isset($_COOKIE["userId"]) ? $_COOKIE["userId"] : "";
$token = isset($_COOKIE["token"]) ? $_COOKIE["token"] : "";

$secret = 'sec!ReT423*&';
$isValidToken = Token::validate($token, $secret);
$decodedToken = Token::getPayload($token);

$sessUser = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

// 2. Read information from cookie or session

$loggedUserId = "";
if ($isValidToken) $loggedUserId = $decodedToken["user_id"];

?>

<div class="pb-5 border-b-2 border-red-500 relative h-[50px]">
    <?php if ($loggedUserId) { ?>
        Selamat datang <?php echo $loggedUserId; ?>
        <a href="./logout" aria-label="Login" class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white absolute right-0">
            Logout
        </a>
    <?php } else { ?>
        <a href="./login" aria-label="Login" class="bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded-full font-semibold text-white absolute right-0">
            Login
        </a>
    <?php } ?>
</div>