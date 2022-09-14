<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../classes/database.php';
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
                $insert_item = mysqli_query($mysqli2, "INSERT INTO table_inventory (name, subname, image, html, server, username, valueini, command) VALUES ('$fetch_store[name]', '$fetch_store[subname]', '$fetch_store[image]', '$fetch_store[html]', '$fetch_store[server]', '$username', '$fetch_store[unitvalue]', '$fetch_store[command]')");
                if ($insert_item) {
                    http_response_code(200);
                    echo json_encode(array('status' => 'success', 'title' => 'ซื้อสินค้า', 'message' => 'เก็บไอเทมไว้ใน Inventory แล้ว'));
                } else {
                    http_response_code(400);
                    echo json_encode(array('status' => 'error', 'title' => 'ซื้อสินค้า', 'message' => 'เกิดข้อผิดพลาด'));
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
