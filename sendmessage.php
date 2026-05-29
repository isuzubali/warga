<?php
$token = "4KY7WmJqDweDDLsNRFep";
function Kirimfonnte($data, $telp)
{
$curl = curl_init();

curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query(array(
            'target' => $telp,
            'message' => $data,
        )),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token
        ),));

$response = curl_exec($curl);
if (curl_errno($curl)) {
  $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
 echo $error_msg;
}
echo $response;
}
// TANGKAP REQUEST DARI INDEX.HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim oleh JavaScript Fetch
    $pesan = isset($_POST['message']) ? $_POST['message'] : '';
    $nomor = isset($_POST['target']) ? $_POST['target'] : '';

    if (!empty($pesan) && !empty($nomor)) {
        // Panggil fungsi Anda dengan parameter ($data, $telp)
        $hasil = Kirimfonnte($pesan, $nomor);
        echo $hasil; 
    } else {
        echo json_encode(['status' => false, 'reason' => 'Data tidak lengkap']);
    }
}
?>
