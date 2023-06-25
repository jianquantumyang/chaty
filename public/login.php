<?php
require_once "../private/db.php";
require_once "../private/utils.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($username != "" && $password != "") {
        $res = authenicate($username, $password, $conn);
        if ($res != "OK") {
            $_SESSION["login_err"] = $res;
        } else { 
            header("Location: /chats.php");
            
        }
    } else {
        $_SESSION["login_err"] = "Заполните все поля";
    }
}
if (isset($_COOKIE["auth"])) {
    header("Location: /chats.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>

    <?php include("head.php"); ?>
</head>

<body class="dark:bg-zinc-900">

    <?php include("navbar.php"); ?>
    <div class="container mx-auto px-4">


        <form method="POST" class="my-4">
            <div class="mb-6">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                <input name="username" minlength="3" maxlength="128" type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your username" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input name="password" minlength="8" maxlength="64" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="********************" required>
            </div>
           
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
        <a href="/register.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">No account?</a>
        <?php
        if (isset($_SESSION["login_err"])) {
            echo "<h2 class='dark:text-red-600 text-red-700'>" . $_SESSION["login_err"] .  "</h2>";
            $_SESSION["login_err"] = "";
        }
        ?>
    </div>



</body>

</html>