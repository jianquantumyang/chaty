CREATE DATABASE `caty`;
--use `caty`;


CREATE TABLE `users`(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL UNIQUE,
    `register` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `password` VARCHAR(128) NOT NULL,
    `avatar` VARCHAR(512) NOT NULL DEFAULT "avatar/avatar.png",
    
    PRIMARY KEY (`id`)
);


CREATE TABLE `chat_message`(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `create_data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `desc` VARCHAR(255) DEFAULT "Chat for messages",

    
    PRIMARY KEY (`id`)
);
CREATE TABLE `messages`(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `messsage` VARCHAR(255) NOT NULL,
    `user_id` BIGINT NOT NULL,
    `chat_message_id` BIGINT NOT NULL,
    PRIMARY KEY (`id`)
);

