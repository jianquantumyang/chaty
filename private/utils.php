<?php
require_once "src/JWT.php";
require_once "src/Key.php";

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;



function new_jwt($payload)
{
    $key = "---BEGIN KEY---gf84b8b62bb^B&#V&RFV@GF8HF&H*!&G&g*&gf*&b@F87hf#*&b*&fb#@*6VGF84N8fn9BEV*FB9bv&b@*gfV9vb2407GH29VB924BGV7B&vhb$#@^*VTGHWUGVBIEHRBFVIPUjbdvkBfsd9UGHFOIBVFIwhfiohifgewuhgfiUGViyeGFHOIEAGFOIGOIYGR3Y8TG9437FYEFGINVOQMEM-OM1J8H724569878%&*^*)&623---END KEY---";
    return JWT::encode($payload, $key, 'HS256');
}



function decode_jwt($jwt)
{
    $key = "---BEGIN KEY---gf84b8b62bb^B&#V&RFV@GF8HF&H*!&G&g*&gf*&b@F87hf#*&b*&fb#@*6VGF84N8fn9BEV*FB9bv&b@*gfV9vb2407GH29VB924BGV7B&vhb$#@^*VTGHWUGVBIEHRBFVIPUjbdvkBfsd9UGHFOIBVFIwhfiohifgewuhgfiUGViyeGFHOIEAGFOIGOIYGR3Y8TG9437FYEFGINVOQMEM-OM1J8H724569878%&*^*)&623---END KEY---";

    return (array) JWT::decode($jwt, new Key($key, 'HS256'));
}




function authenicate($username, $passwords, $conn)
{


    try {
       
        $password = hash('sha256', $passwords);

        // Сохраняем результат запроса в переменную
        $result = $conn->query("SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password';");

        if ($result->num_rows == 1) {
            $token = new_jwt(["user_id" => $result->fetch_assoc()["id"], "username" => $username, "time" => time()]);
            
            setcookie("username", $username, time() + 60 * 60 * 24 * 30, "/","127.0.0.1");
            setcookie("auth", $token, time() + 60 * 60 * 24 * 30, "/","127.0.0.1");

            return "OK";
        } else {
            return "Имя пользователя или пароль неправильный";
        }
    } catch (Exception $e) {
        return "Ошибка побробуйте еще раз";
    }

    return "Ошибка побробуйте еще раз";
}


function check_auth($conn)
{
    if (!isset($_COOKIE["auth"])) {
        return header("Location: /login.php");
    } else {
        $payload = decode_jwt($_COOKIE["auth"]);
        $id = $payload["user_id"];
        $q = $conn->query("SELECT * FROM `users` WHERE `id`='$id';");
        if ($q->num_rows == 0) {
            return header("Location: /login.php");
        }
    }
}


function register_auth($username, $password, $conn)
{
    $q = $conn->query("SELECT * FROM `users` WHERE `username`='$username';");
    if ($q->num_rows == 0) {
        //code
        $conn->query("INSERT INTO `users`(`username`,`password`) VALUES('$username','$password');");
        $res = $conn->query("SELECT * FROM `users` WHERE `username`='$username';");
        if ($res->num_rows == 1) {
            
            $token = new_jwt(["user_id" => $res->fetch_assoc()["id"], "username" => $username, "time" => time()]);
            
            setcookie("username", $username, time() + 60 * 60 * 24 * 30, "/","127.0.0.1");
            setcookie("auth", $token, time() + 60 * 60 * 24 * 30, "/","127.0.0.1");
            return "OK";
        } 
        else 
        {
            return "Ошибка попробуйте еще раз";
        }
    } else {
        return "Имя пользователя уже зарегистрирован";
    }
}
function get_avatar($user_id, $conn)
{
    $res = $conn->query("SELECT `avatar` FROM `users` WHERE `id`= " . (int) $user_id . ";");
    return $res->fetch_assoc();
}






function getChats($conn)
{

    return $conn->query("SELECT * FROM `chat_message` ORDER BY `create_data` DESC;");
}
