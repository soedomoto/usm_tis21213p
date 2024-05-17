<?php

require("./vendor/autoload.php");

use ReallySimpleJWT\Token;


$userId = 12;
$secret = 'sec!ReT423*&';
$expiration = time() + 3600;
$issuer = 'localhost';

$token = Token::create($userId, $secret, $expiration, $issuer);

header("Authorization: Bearer " . $token);
// echo $token;

print_r(headers_list());