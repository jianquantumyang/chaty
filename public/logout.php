<?php

unset($_COOKIE["auth"]);
setcookie('auth','',time()-3600);
header("Location: /login.php");