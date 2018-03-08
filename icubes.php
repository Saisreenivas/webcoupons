<?php

//
// $opts = array(\'http\' =>
//   array(
//     \'method\'  => \'GET\',
//     \'header\'  => "Content-Type: text/json\r\n".
//     \'content\' => $body,
//     \'timeout\' => 10
//   )
// );


// $json_data = file_get_contents($json);

$client = file_get_contents('http://assets.icubeswire.com/dealscoupons/api/getcoupon.php?API_KEY=2f27e0f4118efff145aeecd8367fbb37');

// var_dump($json);
// echo strlen($client);
// echo $client(5989565);
// echo 'working';
$client = substr($client,0 , strlen($client)-3);
$client = $client."}]";
// echo 'json ready';
// echo $client;
$decodedData = (array) json_decode($client);
// var_dump($decodedData);
$result = array();
$int =1;
// echo 'starting';
?>
<?php
foreach ($decodedData as $decodedData) {
  // echo $decodedData->Campaign_Name."Hello</br>";
    // echo $int;
    $returnData['ID'] = $int;
    $returnData['Campaign_Name']=$decodedData->Campaign_Name;
    $returnData['Title']= $decodedData->Title;
    $returnData['Description'] = $decodedData->Description;
    $returnData['Category'] = $decodedData ->Category;
    $returnData['Tracking_URL'] = $decodedData ->Tracking_URL;
  # code...
  // echo json_encode(returnData);
    // if($int ==1){
      // echo "[";
    // }
    // echo json_encode($returnData);
  if($int==100){
    // echo "]";
    echo json_encode($result);
    return true;
  }
  else{
    // echo ",";
    array_push($result,$returnData);
    $int++;
  }

}
// echo json_encode($result);
// echo json_encode($result);

// echo json_encode($returnData);


// echo json_decode($client);
// $client = str_replace("},]", "}]", $client);


// echo $client;
// echo "</br>";
// echo $json;
// $each = json_decode($client);
// echo $client."</br>";
// echo $each;

// echo json_last_error().'<br>'; // 4 (JSON_ERROR_SYNTAX)
// echo json_last_error_msg(); // unexpected character

// $client = new Client();
// $response = $client->post("http://requestb.in/tg4brftg", [
//     \'headers\' => [\'X-Foo\' => \'Bar\'],
//     \'body\'    => [\'field_name\' => \'value\']
// ]);
// var_dump($response->getStatusCode());
// // $client = new GuzzleHttp\Client();
// // $res = $client->request(\'GET\', \'http://assets.icubeswire.com/dealscoupons/api/getcoupon.php?API_KEY=2f27e0f4118efff145aeecd8367fbb37http://assets.icubeswire.com/dealscoupons/api/getcoupon.php?API_KEY=2f27e0f4118efff145aeecd8367fbb37\');
// echo $res->getStatusCode();
// // "200"
// echo $res->getHeader(\'content-type\');
// // \'application/json; charset=utf8\'
// echo $res->getBody();
// // {"type":"User"...\'
//
// // Send an asynchronous request.
// $request = new \GuzzleHttp\Psr7\Request(\'GET\', \'http://httpbin.org\');
// $promise = $client->sendAsync($request)->then(function ($response) {
//     echo \'I completed! \' . $response->getBody();
// });
// $promise->wait();
?>
