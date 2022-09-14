<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    include '../classes/database.php';
    $username = mysqli_real_escape_string($mysqli2, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli2, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli2, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($mysqli2, $_POST['confirmpassword']);
    if (strlen($password) < 8) {
        http_response_code(400);
        echo json_encode(array('status' => 'error','title' => 'สมัครสมาชิก','message' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร'));
    } else if ($password != $confirmpassword) {
        http_response_code(400);
        echo json_encode(array('status' => 'error','title' => 'สมัครสมาชิก','message' => 'รหัสผ่านไม่ตรงกัน'));
    } else {
        $check_username = mysqli_query($mysqli2, "SELECT username FROM authme WHERE username = '$username'");
        if (mysqli_num_rows($check_username) > 0) {
            http_response_code(400);
            echo json_encode(array('status' => 'error','title' => 'สมัครสมาชิก','message' => 'ชื่อผู้ใช้นี้มีผู้ใช้งานแล้ว'));
        } else {
            $check_email = mysqli_query($mysqli2, "SELECT email FROM authme WHERE email = '$email'");
            if (mysqli_num_rows($check_email) > 0) {
                http_response_code(400);
                echo json_encode(array('status' => 'error','title' => 'สมัครสมาชิก','message' => 'อีเมลนี้มีผู้ใช้งานแล้ว'));
            } else {
                function createSalt($length)
                {
                    srand(date("s"));
                    $chars = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $ret_str = "";
                    $num = strlen($chars);
                    for ($i = 0; $i < $length; $i++) {
                        $ret_str .= $chars[rand() % $num];
                    }
                    return $ret_str;
                }
                function hashPassword($orgPassword)
                {
                    $salt = createSalt(16);
                    $hashedPassword = "\$SHA\$" . $salt . "\$" . hash('sha256', hash('sha256', $orgPassword) . $salt);
                    return $hashedPassword;
                }
                $create_user = mysqli_query($mysqli2, "INSERT INTO authme (username ,realname, email, password, created_at) VALUES ('$username','$username','$email','" . hashPassword($password) . "', '".date('Y-m-d H:i:s')."')");
                if ($create_user) {
                    http_response_code(200);
                    echo json_encode(array('status' => 'success','title' => 'สมัครสมาชิก','message' => 'สมัครสมาชิกสำเร็จ'));
                } else {
                    http_response_code(400);
                    echo json_encode(array('status' => 'error','title' => 'สมัครสมาชิก','message' => $mysqli2->error));
                }
            }
        }
    }
}
