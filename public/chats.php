<?php
require_once "../private/db.php";
require_once "../private/utils.php";

check_auth($conn);
?>


<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Chats</title>
  <?php include("head.php"); ?>
</head>

<body class="dark:bg-zinc-900">
  <?php include("navbar.php"); ?>
  <br />
  <div class="container mx-auto px-4">
    <?php
    if (isset(explode('/', $_SERVER['REQUEST_URI'])[2])) {
      $id = (int) explode('/', $_SERVER['REQUEST_URI'])[2];
      $q = $conn->query("SELECT * FROM `chat_message` WHERE `id`='$id';");
      if ($q->num_rows == 1) {
        $res = $q->fetch_assoc();
        $messages = $conn->query("SELECT * FROM `messages` WHERE `chat_message_id`='" .  $res["id"] . "';");

    ?>
        <h1 class="dark:text-white text-2xl text-center"><?php echo $res["name"] ?></h1>
        <p class="dark:text-white text-center"><?php echo $res["desc"] ?></p>
        <!-- Chatting -->
        <div class="flex flex-row justify-between dark:bg-zinc-900 bg-white">

          <!-- message -->
          <div class="w-full px-5 flex flex-col justify-between">
            <div class="messages flex flex-col mt-5">
              <?php $id = decode_jwt($_COOKIE["auth"])["user_id"];
              while ($row = mysqli_fetch_array($messages)) { ?>
                <div class="flex <?php if ($row["user_id"] == $id) {
                                    echo 'justify-end';
                                  } else {
                                    echo 'justify-start';
                                  } ?> mb-4">

                  <?php if ($row["user_id"] == $id) {  ?>

                    <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                      <?php echo $conn->query("SELECT * FROM `users` WHERE `id`='" . $row["user_id"] . "';")->fetch_assoc()["username"] . '<br/>' . $row["messsage"] ?>
                    </div>
                    <img src="/media/<?php echo $conn->query("SELECT * FROM `users` WHERE `id`='" . $row["user_id"] . "';")->fetch_assoc()["avatar"]; ?>" class="object-cover h-8 w-8 rounded-full" alt="" />
                  <?php } else { ?>
                    <img src="/media/<?php echo $conn->query("SELECT * FROM `users` WHERE `id`='" . $row["user_id"] . "';")->fetch_assoc()["avatar"]; ?>" class="object-cover h-8 w-8 rounded-full" alt="" />
                    <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                      <?php echo $conn->query("SELECT * FROM `users` WHERE `id`='" . $row["user_id"] . "';")->fetch_assoc()["username"] . '<br/>' . $row["messsage"] ?>
                    </div>

                  <?php } ?>
                </div>
              <?php } ?>

            </div>
            <div class="py-5">
              <input class="message_txt w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" minlength="1" maxlength="255" placeholder="Сообщение..." /><br />
              <br /><button type="button" id="send_btn" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Отправить</button>

            </div>
          </div>
          <!-- end message -->

        </div>

        <!--Html code-->






      <?php } else { ?>
        <div class="dark:text-white flex justify-center  ">
          Чат пока не создан или закрыт...
        </div>

      <?php }
    } else {

      ?>
      <div class="flex flex-wrap">
        <?php
        $chats = getChats($conn);
        while ($row = mysqli_fetch_array($chats)) {


        ?>

          <div class="w-96 mb-4 mr-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

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
      <?php } ?>
      </div>
  </div>


  <script src="/js/chat.js"></script>
</body>

</html>