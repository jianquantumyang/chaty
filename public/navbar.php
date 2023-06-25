<?php require_once "../private/utils.php";
require_once "../private/db.php"; ?>
<nav class="shadow-lg bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex items-center justify-between">
      <!-- Logo and Links -->
      <div class="flex items-center space-x-7">
        <div>
          <!-- Website Logo -->
          <a href="/" class="flex items-center py-4 px-2">
            <img src="/images/apple-icon.png" alt="Logo" class="h-8 w-8 mr-2">
            <span class="font-semibold text-gray-500 text-lg">Chaty</span>
          </a>
          <h1 class="text-white">

          </h1>
        </div>
        <?php
        function active($name)
        {
          if ($_SERVER["SCRIPT_NAME"] == "/" . $name) {
            echo "text-green-500 border-b-4 border-green-500";
          } else {
            echo "text-gray-500 font-semibold hover:text-green-500";
          }
        }
        function active_li($name)
        {
          if ($_SERVER["SCRIPT_NAME"] == "/" . $name) {
            echo "active";
          }
        }
        //text-sm px-2 py-4 hover:bg-green-500
        function active_mob($name)
        {
          if ($_SERVER["SCRIPT_NAME"] == "/" . $name) {
            echo "block text-sm px-2 py-4 text-white bg-green-500 font-semibold";
          } else {
            echo "block dark:text-white text-sm px-2 py-4 hover:bg-green-500";
          }
        }
        ?>
        <div class="hidden md:flex items-center space-x-1">
          <a href="/" class="py-4 px-2 <?php active('index.php'); ?> font-semibold transition duration-300 ease-in-out">Главная</a>
          <a href="/chats.php" class="py-4 px-2 <?php active('chats.php'); ?> transition duration-300 ease-in-out">Чаты</a>
          <a href="/about.php" class="py-4 px-2 <?php active('about.php'); ?> transition duration-300 ease-in-out">О Нас</a>
          <a href="/create.php" class="py-4 px-2 <?php active('create.php'); ?> transition duration-300 ease-in-out">Создать чат</a>
        </div>
      </div>

      <!-- Secondary Navbar items -->
      <div class="hidden md:flex items-center space-x-3">






        <!-- Profile dropdown -->

        <?php if (!isset($_COOKIE["auth"])) { ?>
          <a href="/login.php" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-green-500 hover:text-white transition duration-300 ease-in-out">Log In</a>

        <?php } else { ?>

          <div class=" ml-3 relative">
            <div>
              <button class="close-profile-bar flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out" id="user-menu" @click="dropdown = !dropdown" aria-label="User menu" aria-haspopup="true">
                <img class="h-6 w-6 rounded-full" src="/media/<?php echo get_avatar(decode_jwt($_COOKIE["auth"])["user_id"], $conn)["avatar"] ?>" alt />
              </button>
            </div>

            <div class="invisible profile-menu  origin-top-right  absolute right-0 mt-2 w-48 rounded-md shadow-lg">
              <div class="py-1 rounded-md dark:bg-gray-900 shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                <a href="/profile.php" class="dark:text-white block px-4 py-2 text-sm leading-5 text-gray-700 dark:hover:bg-gray-700 hover:bg-gray-100  focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Профиль</a>
                <a href="/logout.php" class="dark:text-white block px-4 py-2 text-sm leading-5 text-gray-700 dark:hover:bg-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Выйти</a>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="flex items-center border-l border-slate-200 ml-6 pl-6 dark:border-slate-800">

          <label class="sr-only" id="headlessui-listbox-label-:Rpkcr6:" data-headlessui-state="">Theme</label>
          <button type="button" id="headlessui-listbox-button-:R19kcr6:" aria-haspopup="true" aria-expanded="false" data-headlessui-state="" aria-labelledby="headlessui-listbox-label-:Rpkcr6: headlessui-listbox-button-:R19kcr6:" class="theme-toggle">
            <span class="dark:hidden">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" class="fill-sky-400/20 stroke-sky-500"></path>
                <path d="M12 4v1M17.66 6.344l-.828.828M20.005 12.004h-1M17.66 17.664l-.828-.828M12 20.01V19M6.34 17.664l.835-.836M3.995 12.004h1.01M6 6l.835.836" class="stroke-sky-500"></path>
              </svg>
            </span>
            <span class="hidden dark:inline">
              <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.715 15.15A6.5 6.5 0 0 1 9 6.035C6.106 6.922 4 9.645 4 12.867c0 3.94 3.153 7.136 7.042 7.136 3.101 0 5.734-2.032 6.673-4.853Z" class="fill-sky-400/20"></path>
                <path d="m17.715 15.15.95.316a1 1 0 0 0-1.445-1.185l.495.869ZM9 6.035l.846.534a1 1 0 0 0-1.14-1.49L9 6.035Zm8.221 8.246a5.47 5.47 0 0 1-2.72.718v2a7.47 7.47 0 0 0 3.71-.98l-.99-1.738Zm-2.72.718A5.5 5.5 0 0 1 9 9.5H7a7.5 7.5 0 0 0 7.5 7.5v-2ZM9 9.5c0-1.079.31-2.082.845-2.93L8.153 5.5A7.47 7.47 0 0 0 7 9.5h2Zm-4 3.368C5 10.089 6.815 7.75 9.292 6.99L8.706 5.08C5.397 6.094 3 9.201 3 12.867h2Zm6.042 6.136C7.718 19.003 5 16.268 5 12.867H3c0 4.48 3.588 8.136 8.042 8.136v-2Zm5.725-4.17c-.81 2.433-3.074 4.17-5.725 4.17v2c3.552 0 6.553-2.327 7.622-5.537l-1.897-.633Z" class="fill-sky-400/20"></path>
              </svg>
            </span>
          </button>
        </div>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center">
        <?php if (isset($_COOKIE["auth"])) { ?>
          <div class="mr-4 pr-2 relative">
            <div>
              <button class="close-profile-bar-mobile flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out" id="user-menu" @click="dropdown = !dropdown" aria-label="User menu" aria-haspopup="true">
                <img class="h-6 w-6 rounded-full" src="/media/<?php echo get_avatar(decode_jwt($_COOKIE["auth"])["user_id"], $conn)["avatar"] ?>" alt />
              </button>
            </div>

            <div class="invisible profile-menu-mobile  origin-top-right  absolute right-0 mt-2 w-48 rounded-md shadow-lg">
              <div class="py-1 rounded-md dark:bg-gray-900 shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                <a href="/profile.php" class="dark:text-white block px-4 py-2 text-sm leading-5 text-gray-700 dark:hover:bg-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Профиль</a>
                <a href="/logout.php" class="dark:text-white block px-4 py-2 text-sm leading-5 text-gray-700 dark:hover:bg-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Выйти</a>
              </div>
            </div>
          </div>


        <?php } ?>
        <div class="flex  border-r border-slate-200 mr-4 pr-4 dark:border-slate-800">
          <label class="sr-only" id="headlessui-listbox-label-:Rpkcr6:" data-headlessui-state="">Theme</label>
          <button type="button" id="headlessui-listbox-button-:R19kcr6:" aria-haspopup="true" aria-expanded="false" data-headlessui-state="" aria-labelledby="headlessui-listbox-label-:Rpkcr6: headlessui-listbox-button-:R19kcr6:" class="theme-toggle">
            <span class="dark:hidden">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" class="fill-sky-400/20 stroke-sky-500"></path>
                <path d="M12 4v1M17.66 6.344l-.828.828M20.005 12.004h-1M17.66 17.664l-.828-.828M12 20.01V19M6.34 17.664l.835-.836M3.995 12.004h1.01M6 6l.835.836" class="stroke-sky-500"></path>
              </svg>
            </span>
            <span class="hidden dark:inline">
              <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.715 15.15A6.5 6.5 0 0 1 9 6.035C6.106 6.922 4 9.645 4 12.867c0 3.94 3.153 7.136 7.042 7.136 3.101 0 5.734-2.032 6.673-4.853Z" class="fill-sky-400/20"></path>
                <path d="m17.715 15.15.95.316a1 1 0 0 0-1.445-1.185l.495.869ZM9 6.035l.846.534a1 1 0 0 0-1.14-1.49L9 6.035Zm8.221 8.246a5.47 5.47 0 0 1-2.72.718v2a7.47 7.47 0 0 0 3.71-.98l-.99-1.738Zm-2.72.718A5.5 5.5 0 0 1 9 9.5H7a7.5 7.5 0 0 0 7.5 7.5v-2ZM9 9.5c0-1.079.31-2.082.845-2.93L8.153 5.5A7.47 7.47 0 0 0 7 9.5h2Zm-4 3.368C5 10.089 6.815 7.75 9.292 6.99L8.706 5.08C5.397 6.094 3 9.201 3 12.867h2Zm6.042 6.136C7.718 19.003 5 16.268 5 12.867H3c0 4.48 3.588 8.136 8.042 8.136v-2Zm5.725-4.17c-.81 2.433-3.074 4.17-5.725 4.17v2c3.552 0 6.553-2.327 7.622-5.537l-1.897-.633Z" class="fill-sky-400/20"></path>
              </svg>
            </span>
          </button>
        </div>

        <button class="outline-none mobile-menu-button">
          <svg class="w-6 h-6 text-gray-500" x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>

        </button>
      </div>
    </div>
  </div>
  </div>

  <!-- Mobile Menu -->
  <div class="hidden mobile-menu">
    <ul class="px-2 py-3 space-y-2">
      <li class="<?php active_li('index.php'); ?>"><a href="/" class="<?php active_mob('index.php'); ?>">Главная</a></li>
      <li class="<?php active_li('chats.php'); ?>"><a href="/chats.php" class="<?php active_mob('chats.php'); ?>">Чаты</a></li>
      <li class="<?php active_li('about.php'); ?>"><a href="/about.php" class="<?php active_mob('about.php'); ?>">О Нас</a></li>
      <li class="<?php active_li('create.php'); ?>"><a href="/create.php" class="<?php active_mob('create.php'); ?>">Создать чат</a></li>
      <?php if (!isset($_COOKIE["auth"])) { ?>
        <li class="<?php active_li('login.php'); ?>"><a href="/login.php" class="<?php active_mob('login.php'); ?>">Логин</a></li>

      <?php } ?>
    </ul>
  </div>
</nav>

<script src="/js/navbar.js"></script>