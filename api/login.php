<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    include '../classes/database.php';
    $username = mysqli_real_escape_string($mysqli2, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli2, $_POST['password']);
    $sql_check_user = "SELECT * FROM authme WHERE username = '$username'";
    $sql_result_user = mysqli_query($mysqli2, $sql_check_user);
    if ($sql_result_user) {
        if (mysqli_num_rows($sql_result_user) == 1) {
            $row_fetch_user = mysqli_fetch_assoc($sql_result_user);
            $sha_info = explode("$", $row_fetch_user['password']);
            $salt_hash = $sha_info[2];
            $sha256_password = hash('sha256', $password);
            $sha256_password .= $sha_info[2];
            if (strcasecmp(trim($sha_info[3]), hash('sha256', $sha256_password)) == 0) {
                $sql_user_signin = "SELECT * FROM authme WHERE username = '$username'";
                $sql_result_user_signin = mysqli_query($mysqli2, $sql_user_signin);
                $fetch_user_result = mysqli_fetch_assoc($sql_result_user_signin);

                $_SESSION['authme_username'] = $fetch_user_result['username'];
                http_response_code(200);
                echo json_encode(array('status' => 'success', 'title' => 'เข้าสู่ระบบ', 'message' => 'เข้าสู่ระบบเรียบร้อย'));
            } else {
                http_response_code(400);
                echo json_encode(array('status' => 'error', 'title' => 'เข้าสู่ระบบ', 'message' => 'โปรดตรวจสอบ Password ให้ตรงกับที่ลงทะเบียนไว้'));
            }
        } else {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'title' => 'เข้าสู่ระบบ', 'message' => 'ไม่พบ Username นี้ในระบบ'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'title' => 'เข้าสู่ระบบ', 'message' => 'ไม่พบ Username นี้ในระบบ'));
    }
}
?>