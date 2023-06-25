<?php
require_once "db.php";
require_once "utils.php";

use Workerman\Worker;

require_once __DIR__ . '/vendor/autoload.php';
$ws = new Worker('websocket://127.0.0.1:3002');







$ws->onConnect = function ($connection) {
    echo "New connection\n";
};

// Emitted when data received
$ws->onMessage = function ($connection, $data) use ($ws,$conn) {
    // Send hello $data
    try {
        
        $data = json_decode($data, true);
        
        $payload = decode_jwt($data["auth"]);
        $userId = $payload["user_id"];
        $username = $payload["username"];
        $message = $data["message"];
        $chat_message = $data["chat_id"];


        $conn->query("INSERT INTO `messages` (`user_id`,`messsage`,`chat_message_id`) VALUES('$userId','$message','$chat_message');");

        $messagea = json_encode(["username"=>$username,
        "avatar"=>$conn->query("SELECT * FROM `users` WHERE `id`='$userId';")->fetch_assoc()["avatar"],
        "message"=> $message
    ]);
        
        
        foreach ($ws->connections as $clientConnection) {
            $clientConnection->send($messagea);
        }
    } catch (Exception $e) {
    }
};

// Emitted when connection closed
$ws->onClose = function ($connection) {
    echo "Connection closed\n";
};






Worker::runAll();
