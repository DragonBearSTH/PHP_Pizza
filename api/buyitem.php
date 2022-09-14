<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../classes/database.php';
    include '../classes/Rcon.php';
    $itemid = mysqli_real_escape_string($mysqli2, $_POST['itemid']);
    $username = mysqli_real_escape_string($mysqli2, $_POST['username']);
    if (!empty($itemid) && !empty($username)) {
        $store = mysqli_query($mysqli2, "SELECT * FROM table_store WHERE id = '$itemid'");
        $fetch_store = mysqli_fetch_assoc($store);
        $user = mysqli_query($mysqli2, "SELECT * FROM authme WHERE username = '$username'");
        $fetch_user = mysqli_fetch_assoc($user);
        if ($fetch_user['point'] < $fetch_store['price']) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'title' => 'ซื้อสินค้า', 'message' => 'คุณมีเงินไม่พอ'));
        } else {
            $update_point = mysqli_query($mysqli2, "UPDATE authme SET point = point - '$fetch_store[price]' WHERE username = '$username'");
            if ($update_point) {
                    $server = mysqli_query($mysqli2, "SELECT * FROM table_server WHERE name = '$fetch_store[server]'");
                    $fetch_server = mysqli_fetch_assoc($server);
                    if (mysqli_num_rows($server) !== 0) {
                    $rcon = new Rcon($fetch_server['ipaddress'], $fetch_server['rconport'], $fetch_server['rconpassword'], '10');
                    if ($rcon->connect()) {
                        $command = str_replace("<player>", $username, $fetch_store["command"]);
                        $rcon->sendCommand($command);
                        $rcon->disconnect();
                        $history_item = mysqli_query($mysqli2, "INSERT INTO table_history_item (name, valueini, username) VALUES ('$fetch_store[name]', '$fetch_store[unitvalue]', '$username')");
                        http_response_code(200);
                        echo json_encode(array('status' => 'success', 'title' => 'ซื้อสินค้า', 'message' => 'เก็บไอเทมไว้ใน Inventory แล้ว'));
                    } else {
                        http_response_code(400);
                        echo json_encode(array('status' => 'error', 'title' => 'ซื้อสินค้า', 'message' => 'ไม่สามารถเชื่อต่อ RCON ได้'));
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array('status' => 'error', 'title' => 'ซื้อสินค้า', 'message' => 'ไม่พบข้อมูลเซิร์ฟเวอร์'));
                }
            } else {
                http_response_code(400);
                echo json_encode(array('status' => 'error', 'title' => 'ซื้อสินค้า', 'message' => 'เกิดข้อผิดพลาด'));
            }
        }
    } else {
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'title' => 'ซื้อสินค้า', 'message' => 'กรุณากรอกข้อมูลให้ครบ'));
    }
}
