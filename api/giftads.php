<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../classes/database.php';
    $newusername = mysqli_real_escape_string($mysqli2, $_POST['newusername']);
    $username = mysqli_real_escape_string($mysqli2, $_POST['username']);
    if ($newusername == $username) {
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'title' => 'Gift item', 'message' => 'ชื่อผู้ใช้ใหม่ต้องไม่เหมือนกับชื่อผู้ใช้เดิม'));
    } else {
        $sql_check_inv = mysqli_query($mysqli2, "SELECT * FROM table_inventory WHERE username = '$username'");
        $fetch = mysqli_fetch_assoc($sql_check_inv);
        $insert = mysqli_query($mysqli2, "INSERT INTO table_inventory (name, subname, image, html, server, username, valueini, command) VALUES ('$fetch[name]', '$fetch[subname]', '$fetch[image]', '$fetch[html]', '$fetch[server]', '$newusername', '$fetch[valueini]', '$fetch[command]')");
        if ($insert) {
            $delete = mysqli_query($mysqli2, "DELETE FROM table_inventory WHERE name = '$fetch[name]' AND username = '$username'");
            if ($delete) {
                http_response_code(200);
                echo json_encode(array('status' => 'success', 'title' => 'Gift item', 'message' => 'ส่งไอเทมให้ผู้ใช้ใหม่แล้ว'));
            } else {
                http_response_code(400);
                echo json_encode(array('status' => 'error', 'title' => 'Gift item', 'message' => 'เกิดข้อผิดพลาด'));
            }
        } else {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'title' => 'Gift item', 'message' => 'เกิดข้อผิดพลาด'));
        }

    }
}
