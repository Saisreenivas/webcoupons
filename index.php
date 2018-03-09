<?php
$me = func();
echo $me;

  function func(){
    return 4;
  }
 ?>

<!-- <?php
// $conn_error = 'Could not connect';
//
// $mysql_host = 'localhost';
// $mysql_user = 'root';
// $mysql_pass = '1';
//
// $mysql_db = 'coupons_app_data';
//
// $conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
// $mysql_table = 'offers_database';
// if($conn === false){
//
//  die($conn_error);
//
// }else{
// 	// echo '<p align="center">Connected</p>';
// }
// ?>
// <?php
//
// $client = file_get_contents('http://assets.icubeswire.com/dealscoupons/api/getcoupon.php?API_KEY=2f27e0f4118efff145aeecd8367fbb37');
//
// // var_dump($json);
// // echo strlen($client);
// // echo $client(5989565);
// // echo 'working';
// $client = substr($client,0 , strlen($client)-3);
// $client = $client."}]";
// $client = str_replace("'","''",$client);
// // echo 'json ready';
// // echo $client;
// // echo $client;
// $decodedData = (array) json_decode($client);
//
// // var_dump($decodedData);
// $result = array();
// // echo 'starting';
// ?>
// <?php
// foreach ($decodedData as $decodedData) {
//   // echo $decodedData->Campaign_Name."Hello</br>";
//   // echo $int;
//   // $returnData['Campaign_Name']=$decodedData->Campaign_Name;
//   // $returnData['Title']= $decodedData->Title;
//   // $returnData['Description'] = $decodedData->Description;
//   // $returnData['Category'] = $decodedData ->Category;
//   // $returnData['Tracking_URL'] = $decodedData ->Tracking_URL;
//
//   if($decodedData->Campaign_ID!=null ){
//     if($decodedData->Expiry_Date == "0000-00-00"){
//       $decodedData->Expiry_Date = "2022-02-02";
//     }
//     echo gettype($decodedData->Campaign_Name);
//     echo gettype($decodedData->Campaign_ID);
//     if(gettype($decodedData->Campaign_Name) == 'integer'){
//       $name = $decodedData->Campaign_Name;
//       $decodedData->Campaign_Name = $decodedData->Campaign_ID;
//       $decodedData->Campaign_ID = $name;
//     }
//   // $query = "INSERT INTO `offers_database` (`id`, `offer_id`, `api_name`, `offer_company`,
//   //    `offer_title`, `offer_description`, `offer_category`, `offer_tracking_url`,
//   //    `offer_expiry_date`) VALUES (NULL, '".$decodedData->Campaign_ID."', 'icubeswire',
//   //    '".$decodedData->Campaign_Name."', '".$decodedData->Title."', '".$decodedData->Description."',
//   //     '".$decodedData->Category."', '".$decodedData->Tracking_URL."', '".$decodedData->Expiry_Date."');";
//   //
//   //     if($data = mysqli_query($conn, $query)){
//   //        echo 'success';
//   //     }else{
//   //       echo "</br>".mysqli_error($conn);
//   //       return false;
//   //       // echo "</br> Result error".mysqli_error($conn);
//   //     }
// }
//   # code...
//   // echo json_encode(returnData);
//   // if($int ==1){
//   // echo "[";
//   // }
//   // echo json_encode($returnData);
//   // if($int==100){
//   //   // echo "]";
//   //   echo json_encode($result);
//   //   return true;
//   // }
//   // else{
//   //   // echo ",";
//   //   array_push($result,$returnData);
//   //   $int++;
//   // }
//
// }
?> -->
