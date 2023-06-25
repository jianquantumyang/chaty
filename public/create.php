<?php

require_once "../private/db.php";
require_once "../private/utils.php";
check_auth($conn);
if($_SERVER["REQUEST_METHOD"]=="POST")
{   
    $name = $_POST["name"];

    $desc = $_POST["desc"];
    if($name!="" && $desc!="")
    {
        $conn->query("INSERT INTO `chat_message`(`name`,`desc`) VALUES('$name','$desc');");
        $id = $conn->query("SELECT * FROM `chat_message` WHERE `name`='$name';")->fetch_assoc()["id"];
        header("Location: /chats.php/" . $id);
    }
    else
    {
        $_SESSION["create_err"] = "заполните все поля";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Create chat</title>

    <?php include("head.php"); ?>
</head>

<body class="dark:bg-zinc-900">
    <?php include("navbar.php"); ?>
        <div class="container mx-auto px-4">

        <h1 class="mt-4 text-2xl text-center dark:text-white">Create chat room</h1>
        <form method="post">

            <br /><input name="name" maxlength="32" placeholder="Chat name" minlength="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" />
            <br /><textarea name="desc" maxlength="128" minlength="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Chat for messages</textarea>
            <br /><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
        </form>
        <?php
        if (isset($_SESSION["login_err"])) {
            echo "<h2 class='dark:text-red-600 text-red-700'>" . $_SESSION["create_err"] .  "</h2>";
            $_SESSION["create_err"] = "";
        }
        ?>
    </div>



</body>

</html>