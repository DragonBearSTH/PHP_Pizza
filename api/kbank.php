<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_reporting(0);
    include '../classes/database.php';
    include '../classes/gateway/kasikornbank.class.php';
    $date = mysqli_real_escape_string($mysqli2, $_POST['date']);
    $time = mysqli_real_escape_string($mysqli2, $_POST['time']);
    $username = mysqli_real_escape_string($mysqli2, $_POST['username']);
    $fetchtime = $date . ' ' . $time;
    $setting = mysqli_query($mysqli2, "SELECT * FROM table_setting");
    $fetch_setting = mysqli_fetch_assoc($setting);
    $kbank = new KBiz($fetch_setting['kbiz_username'], $fetch_setting['kbiz_password'], $fetch_setting['kbiz_number']);
    if ($kbank->login()) {
        $getTransactions = $kbank->getTransactions();
        if (!empty($getTransactions)) {
            foreach ($getTransactions as $key => $value) {
                if ($value['debitCreditIndicator'] == 'CR') {
                    $transDate = $value['transDate'];
                    $depositAmount = $value['depositAmount'];
                    $origRqUid = $value['origRqUid'];
                    $sql_check = "SELECT * FROM table_kbank WHERE origRqUid = '$origRqUid'";
                    $dateTime = date_create(date("Y-m-d H:i:s", strtotime($transDate)))->format('Y-m-d H:i');
                    $dateTime2 = date_create(date("Y-m-d H:i:s", strtotime($transDate)))->format('Y-m-d');
                    $sql_result_check = mysqli_query($mysqli2, $sql_check);
                    if (mysqli_num_rows($sql_result_check) == 0) {
                        $sql_insert = mysqli_query($mysqli2, "INSERT INTO table_kbank (transDate, depositAmount, origRqUid) VALUES ('$dateTime', '$depositAmount', '$origRqUid')");
                        if ($sql_insert) {
                            $check = mysqli_query($mysqli2, "SELECT * FROM table_kbank WHERE transDate = '$fetchtime'");
                            if (mysqli_num_rows($check) == 1) {
                                $fetch = mysqli_fetch_assoc($check);
                                if ($fetch['status'] == 'notactive') {
                                    $rp = $depositAmount / 2;
                                    $sql_update = mysqli_query($mysqli2, "UPDATE authme SET point = point + '$depositAmount', rp = rp + '$rp', sumpoint = sumpoint + '$depositAmount' WHERE username = '$username'");
                                    if ($sql_update) {
                                        $status = mysqli_query($mysqli2, "UPDATE table_kbank SET status = 'active' WHERE transDate = '$fetchtime'");
                                        $insert = mysqli_query($mysqli2, "INSERT INTO table_history (username, type, amount, date) VALUES ('$username', 'Kbank', '$depositAmount', '" . date('Y-m-d H:i:s') . "')");
                                        if ($status) {
                                            http_response_code(200);
                                            echo json_encode(array('status' => 'success', 'title' => 'เติมเงิน', 'message' => 'เติมเงินเรียบร้อยจำนวน ' . $depositAmount . ' บาท'));
                                        } else {
                                            http_response_code(400);
                                            echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'เติมเงินไม่สำเร็จ'));
                                        }
                                    } else {
                                        http_response_code(400);
                                        echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'เติมเงินไม่สำเร็จ'));
                                    }
                                } else {
                                    http_response_code(400);
                                    echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'ธุระกรรมนี้ถูกใช้งานแล้ว'));
                                }
                            } else {
                                http_response_code(400);
                                echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'ไม่พบธุระกรรมนี้ในระบบ'));
                            }
                        }
                    } else {
                        $check = mysqli_query($mysqli2, "SELECT * FROM table_kbank WHERE transDate = '$fetchtime'");
                        if (mysqli_num_rows($check) == 1) {
                            $fetch = mysqli_fetch_assoc($check);
                            if ($fetch['status'] == 'notactive') {
                                $rp = $depositAmount / 2;
                                $sql_update = mysqli_query($mysqli2, "UPDATE authme SET point = point + '$depositAmount', rp = rp + '$rp' WHERE username = '$username'");
                                if ($sql_update) {
                                    $status = mysqli_query($mysqli2, "UPDATE table_kbank SET status = 'active' WHERE transDate = '$fetchtime'");
                                    $insert = mysqli_query($mysqli2, "INSERT INTO table_history (username, type, amount, date) VALUES ('$username', 'Kbank', '$depositAmount', '" . date('Y-m-d H:i:s') . "')");
                                    if ($status) {
                                        http_response_code(200);
                                        echo json_encode(array('status' => 'success', 'title' => 'เติมเงิน', 'message' => 'เติมเงินเรียบร้อยจำนวน ' . $depositAmount . ' บาท'));
                                    } else {
                                        http_response_code(400);
                                        echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'เติมเงินไม่สำเร็จ'));
                                    }
                                } else {
                                    http_response_code(400);
                                    echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'เติมเงินไม่สำเร็จ'));
                                }
                            } else {
                                http_response_code(400);
                                echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'ธุระกรรมนี้ถูกใช้งานแล้ว'));
                            }
                        } else {
                            http_response_code(400);
                            echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'ไม่พบธุรกรรมในระบบ'));
                        }
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'ไม่พบธุระกรรมนี้ในระบบ'));
                }
            }
        } else {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'title' => 'เติมเงิน', 'message' => 'ไม่มีรายการจากธนาคาร'));
            // var_dump($getTransactions);
        }
    } else {
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'title' => 'Kasikornbank', 'message' => 'ไม่สามารถเชื่อมต่อกับ Kasikornbank ได้'));
    }
}


// Array
// (
//     [0] => Array
//         (
//             [transDate] => 2022-09-11 18:34:39
//             [effectiveDate] => Sun Sep 11 07:00:00 ICT 2022
//             [transNameTh] => รับโอนเงิน
//             [transNameEn] => Transfer Deposit
//             [depositAmount] => 600
//             [withdrawAmount] => 
//             [accountPartner] => label.bank.k2k.account
//             [channelTh] => K PLUS
//             [channelEn] => K PLUS
//             [origRqUid] => 509_20220911_1cafe1b0416a46fa8d6afc884f0204f2
//             [toAccountNumber] => xxx-x-x5080-x
//             [fromAccountNameEn] => MR. Suwat Surin++
//             [fromAccountNameTh] => นาย สุวัจน์ สุรินต++
//             [benefitAccountNameTh] => 
//             [benefitAccountNameEn] => 
//             [transType] => FTOT
//             [originalSourceId] => 509
//             [transCode] => 0900
//             [debitCreditIndicator] => CR
//             [proxyTypeCode] => 
//             [proxyId] => 
//             [proxyIdMasking] => 
//             [toAccount] => Array
//                 (
//                     [bank] => KBNK
//                     [accountNo] => xxx-x-x5080-x
//                     [accountName] => 
//                 )

//         )

// )