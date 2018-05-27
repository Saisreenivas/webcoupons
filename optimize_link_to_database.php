<?php
// $conn_error = 'Could not connect';
//
// $mysql_host = 'peak.cwtinczi5fmr.us-east-2.rds.amazonaws.com';
// $mysql_user = 'vinodsai';
// $mysql_pass = 'Sai_1234';
// $mysql_db = 'coupons_app_data';
//
// $conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
// $mysql_table = 'offers_database';
// if($conn === false){
//   echo 'not connected';
//  die($conn_error);
//
// }else{
// 	echo '<p align="center">Connected</p>';
// }

require 'db_connect.php';
$mysql_table = 'offers_database';

?>
<?php
$store = "optimize";
// ///////////////////////Deletes data from database
$dataDeleteQuery = "Delete  from ".$mysql_table." WHERE api_name like '".$store."'";
if($data = mysqli_query($conn, $dataDeleteQuery)){
    echo 'deleted</br>';
}else{
  echo 'not deleted </br>';
}
// ///////////////////////
?>
<?php

error_reporting(E_ALL ^ E_WARNING);

date_default_timezone_set("UTC");
$t = microtime(true);
$micro = sprintf("%03d",($t - floor($t)) * 1000);
$utc = gmdate('Y-m-d H:i:s.', $t).$micro;

$sig_data= $utc;

$api_key='b082b80a-6a1b-428e-9386-a9e3f8ed4ba0';
$private_key='93ee9cd38724483583f9f144acc6034a';

$concateData = $private_key.$sig_data;
$sig = md5($concateData);

$url = "https://api.omgpm.com/network/OMGNetworkApi.svc/v1.2.1/ProductFeeds/GetProducts?&" . http_build_query(array('Currency'=>'INR','Keyword'=>'amazon','AID'=>1036662,'AgencyID'=>'95','Key' => $api_key, 'Sig' => $sig, 'SigData' => $sig_data));

$headers = array("Content-Type: application/json",
"Accept: application/json",
"Access-Control-Request-Method: GET");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// print_r($result);
// var_dump(json_decode($result));
$decodedDatas = json_decode($result);
// var_dump($decodedDatas);
func($decodedDatas, $store, $conn);
?>

<?php
// // Create a stream
// $opts = [
//     "http" => [
//         "method" => "GET",
//         "header" => "Fk-Affiliate-Id: komalvash\r\n" .
//             "Fk-Affiliate-Token: 7c6e0e21eac043039163b4c5fb07a052\r\n"
//     ]
// ];
//
// $context = stream_context_create($opts);
//
// // Open the file using the HTTP headers set above
// $client = file_get_contents('https://affiliate-api.flipkart.net/affiliate/offers/v1/all/json', false, $context);
// $client = str_replace("'","''",$client);
// ?>
 <?php

// $store = "flipkart";
// $decodedDatas = json_decode($client);
// func($decodedDatas, $store,$conn);
//
//
// ?>
 <?php
function func($decodedDatas, $store,$conn){
  foreach ($decodedDatas as $decoded) {
    foreach ($decoded as $decodedData) {
      # code...

      // foreach ($decodedData->imageUrls as $img) {
        // foreach ($img as $image) {
          # code...
//       //     if($image->resolutionType == "low"){
//       //       $final_image = $image->url;
//       //     }
//       //   }
//       //   # code...
//       // }
      if($decodedData->StockAvailability == "In stock"){
        $decodedData->coupon_expiry = "2022-02-02";
        // $decodedData->coupon_expiry= date('Y-m-d',($decodedData->endTime/1000));
        // echo $decodedData->coupon_expiry->format('Y-m-d ');
        // echo $decodedData->coupon_expiry;
      }else{
        continue;
      }
//     // echo $decodedData->Campaign_Name."Hello</br>";
//     // echo $int;
//     // $returnData['Campaign_Name']=$decodedData->Campaign_Name;
//     // $returnData['Title']= $decodedData->Title;
//     // $returnData['Description'] = $decodedData->Description;
//     // $returnData['Category'] = $decodedData ->Category;
//     // $returnData['Tracking_URL'] = $decodedData ->Tracking_URL;
//     foreach ($decodedData->imageUrls as $image) {
//       # code...
//       if($image->resolutionType =="low"){
//         $imageUrl = $image->url;
//       }
//     }
//
//
    $decodedData->ProductDescription = str_replace("'","''",$decodedData->ProductDescription);
    $decodedData->ProductName= str_replace("'","''",$decodedData->ProductName);
    $decodedData->MerchantDomain= str_replace("'","''",$decodedData->MerchantDomain);
    $query = "INSERT INTO `offers_database` (`id`, `offer_id`, `api_name`, `offer_company`,
      `offer_company_image`,`offer_title`, `offer_description`, `offer_category`, `offer_tracking_url`,
        `offer_code`,`offer_expiry_date`) VALUES (NULL, $decodedData->MID , '".$store."',
        '".$decodedData->MerchantDomain."','".$decodedData->MerchantLogoURL."' ,'".$decodedData->ProductName."',
         '".$decodedData->ProductDescription." ',
         '".$decodedData->CategoryPathAsString."', '".$decodedData->ProductURL."','NULL', '".$decodedData->coupon_expiry."');";

         if($data = mysqli_query($conn, $query)){
            echo 'success';
        }else{
          echo "</br>".mysqli_error($conn);
          continue;
          // echo "</br> Result error".mysqli_error($conn);
        }
  }
}
}
 ?>
