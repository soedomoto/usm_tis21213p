<?php

setcookie('UID', 1000, 0, "", "", true);

setcookie('UID', 1000, time() - 3600, "", "", true);

print_r($_COOKIE);