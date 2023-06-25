<?php


?>

<!DOCTYPE html>
<html class="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Chaty</title>
  <?php include("head.php"); ?>

  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="application-name" content="Chaty">
  <meta name="apple-mobile-web-app-title" content="Chaty">
  <meta name="theme-color" content="#0275d8">
  <meta name="msapplication-navbutton-color" content="#0275d8">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="msapplication-starturl" content="/">
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="msapplication-TileImage" content="/images/ms-icon-144x144.png" />
  <meta name="theme-color" content="#ffffff" />


  <link rel="manifest" href="/manifest.json">
</head>

<body class="dark:bg-zinc-900">

  <?php include("navbar.php"); ?>
  <br />
  <div class="container mx-auto px-4">
    <h1 class="dark:text-white text-center tracking-wide text-2xl">Welcome to Chaty!</h1><br />
    <h1 class="dark:text-white text-center tracking-wide text-xl">Discover and meet friendly people just like you. Connect and chat with your friends.</h1>

    <br />
    <div class="flex flex-wrap">
      <?php
      $chats = getChats($conn);
      while ($row = mysqli_fetch_array($chats)) {


      ?>

        <div class="w-96 mb-4 mr-2  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

          <div class="p-5">
            <a href="/chats.php/<?php echo $row["id"] ?>">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $row["name"] ?></h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo $row["desc"] ?></p>
            <a href="/chats.php/<?php echo $row["id"] ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Зайти
              <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </a>
          </div>
        </div>

      <?php } ?>
    </div>
  </div>

  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('./sw.js');
      });
    }
  </script>

</body>

</html>