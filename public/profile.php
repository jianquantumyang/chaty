<?php

require_once "../private/db.php";
require_once "../private/utils.php";

$user = decode_jwt($_COOKIE["auth"]);
check_auth($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $file = $_FILES['avatar'];

    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $type = $_FILES["avatar"]["type"];
    if(!in_array($type, $allowedImageTypes))
    {
        echo "<h1 class='text-red-900'>This is not image!</h1>";
    }
    else
    {
        $targetDirectory = './media/avatar/';

        // Generate a unique filename for the image
        $fileName = uniqid('image_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
       
        // Build the path to save the image
        $targetPath = $targetDirectory . $fileName;
        // Move the uploaded file to the target path
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $conn->query("UPDATE `users` SET `avatar` = '" ."avatar/" . $fileName ."' WHERE `id` = '".$user["user_id"] . "';");

        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile</title>

    <?php include("head.php"); ?>
</head>

<body class="dark:bg-zinc-900">

    <?php include("navbar.php"); ?>
    <br />
    <div class="container mx-auto px-4">
        <h1 class="dark:text-white text-xl">Your username: <?php echo $user["username"] ?></h1>
        <img class="h-auto max-w-lg" src="/media/<?php $id = $user["user_id"];
                                                    echo $conn->query("SELECT * FROM `users` WHERE `id`='$id';")->fetch_assoc()["avatar"]; ?>" />
        <form enctype="multipart/form-data"  method="post">

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
            <input name="avatar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF (MAX. 800x400px).</p>
            <br /><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change avatar</button>

        </form>
    </div>

</body>

</html>