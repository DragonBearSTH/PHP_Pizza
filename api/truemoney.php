<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../classes/database.php';
    $query_license = mysqli_query($mysqli1, "SELECT * FROM table_agent WHERE domain = '$_SERVER[HTTP_HOST]'");
    $license = mysqli_fetch_array($query_license);
    if (mysqli_num_rows($query_license) == 0) {
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'title' => 'เข้าสู่ระบบ', 'message' => 'ไม่พบ License นี้ในระบบ'));
    } else {
        $ref_voucher = mysqli_real_escape_string($mysqli2, $_POST['ref_code']);
        $username = mysqli_real_escape_string($mysqli2, $_POST['username']);
        if (empty($ref_voucher)) {
            http_response_code(401);
            echo json_encode(array('status' => 'error', 'title' => 'TrueWallet Gift', 'message' => 'โปรดกรอกรหัสอ้างอิง'));
        } else {
            include '../classes/gateway/truemoney.class.php';
            $setting = mysqli_query($mysqli2, "SELECT * FROM table_setting");
            $fetch_setting = mysqli_fetch_assoc($setting);
            $voucher = new Voucher($fetch_setting['tnm_phone'], $ref_voucher);
            $truewallet = $voucher->redeem();
            switch ($truewallet->status->code) {
                case 'VOUCHER_OUT_OF_STOCK';
                    http_response_code(401);
                    echo json_encode(array('message' => 'ซองของขวัญถูกใช้ไปแล้ว', 'status' => 'error', 'title' => 'TrueWallet Gift'));
                    break;
                case 'VOUCHER_NOT_FOUND';
                    http_response_code(401);
                    echo json_encode(array('message' => 'ไม่พบซองของขวัญ', 'status' => 'error', 'title' => 'TrueWallet Gift'));
                    break;
                case 'CANNOT_GET_OWN_VOUCHER';
                    http_response_code(401);
                    echo json_encode(array('message' => 'เข้าของไม่สามารถรับได้เอง', 'status' => 'error', 'title' => 'TrueWallet Gift'));
                    break;
                case 'VOUCHER_EXPIRED';
                    http_response_code(401);
                    echo json_encode(array('message' => 'ซองของขวัญหมดอายุ', 'status' => 'error', 'title' => 'TrueWallet Gift'));
                    break;
                case 'SUCCESS';
                    $amount = $truewallet->data->voucher->amount_baht;
                    $rp = $amount / 2;
                    $update = mysqli_query($mysqli2, "UPDATE authme SET point = point + '$amount', rp = rp + '$rp', sumpoint = sumpoint + '$amount' WHERE username = '$username'");
                    if ($update) {
                        $insert = mysqli_query($mysqli2, "INSERT INTO table_history (username, type, amount, date) VALUES ('$username', 'TrueWallet', '$amount', '" . date('Y-m-d H:i:s') . "')");
                        if ($insert) {
                            http_response_code(200);
                            echo json_encode(array('message' => 'เติมเงินเข้าสู่บัญชีสำเร็จ จำนวน ' . $truewallet->data->voucher->amount_baht . ' บาท', 'status' => 'success', 'title' => 'TrueWallet Gift'));
                        } else {
                            http_response_code(401);
                            echo json_encode(array('message' => 'เกิดข้อผิดพลาดในการเพิ่มประวัติ', 'status' => 'error', 'title' => 'TrueWallet Gift'));
                        }
                    } else {
                        http_response_code(401);
                        echo json_encode(array('message' => 'เกิดข้อผิดพลาดในการเพิ่มเงิน', 'status' => 'error', 'title' => 'TrueWallet Gift'));
                    }
                    break;
            }
        }
    }
}
