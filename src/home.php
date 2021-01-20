<?php
    
require 'oop.php';
require 'mdb_connection.php';
$mdb = mdb_connect();
session_start();
$current_user = $_SESSION['object'];
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/php_chatter/resources/css/stylesheet.css">
    <script src="/php_chatter/resources/js/gui.js"></script>
</head>
<body>
    
<div class="tab">
<?php

$chat_rooms = $current_user->get_chat_rooms();
for ($i = 0; $i < count($chat_rooms); $i++) {

    $name = $chat_rooms[$i]->get_name();
    echo "<button class=\"tablinks\" onclick=\"open_pane(event, '$i')\">$name</button>";

}
    
?>
</div>
<?php

for ($i = 0; $i < count($chat_rooms); $i++) {

    echo "<div id=\"$i\" class=\"tabcontent\">";
    //echo var_dump($chat_rooms[$i]->get_messages());
    $messages = $chat_rooms[$i]->get_messages();
    for ($x = 0; $x < count($messages); $x++) {

        $message = $messages[$x];
        echo "<p class=\"message_info\">".$message->get_owner()." ".$message->get_time_stamp()."</p>";
        echo "<p class=\"message_text\">".$message->get_text()."</p>";

    }
    echo "</div>";

}
?>

</body>
</html>
