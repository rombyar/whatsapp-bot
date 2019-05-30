<?php

$username = 'root';
$password = '12345';

try {
    $connect = new PDO('mysql:host=localhost;dbname=db_whatsapp', $username, $password);
    //echo 'Konek';
} catch (PDOException $e) {
    echo 'Error: '.$e->getMessage().'<br/>';
    die();
}

$result = $connect->prepare('SELECT * FROM tb_user');
$result->execute();
$countCheck = $result->rowCount();
if ($countCheck != 0) {
    while ($data_row = $result->fetch()) {
        $message = 'Pesan: *'.$data_row['name']."*\n";
        $my_apikey = 'KEY-APIWHA';
        $destination = $data_row['phone'];
        $message = $message;
        $api_url = 'http://panel.apiwha.com/send_message.php';
        $api_url .= '?apikey='.urlencode($my_apikey);
        $api_url .= '&number='.urlencode($destination);
        $api_url .= '&text='.urlencode($message);
        $my_result_object = json_decode(file_get_contents($api_url, false));
        $kirim = 'Send';
    }
    echo $kirim;
} else {
    echo 'Data tidak ditemukan!';
}
