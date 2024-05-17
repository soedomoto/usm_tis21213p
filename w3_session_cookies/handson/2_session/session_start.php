<?php

session_start([
    'cookie_lifetime' => 14400,
    'cookie_secure' => true,
    'cookie_httponly' => true
  ]);

if (!isset($_SESSION["counter"])) {
    $_SESSION["counter"] = 1;
} else {
    $_SESSION["counter"] = $_SESSION["counter"] + 1;
}

echo $_SESSION["counter"];
