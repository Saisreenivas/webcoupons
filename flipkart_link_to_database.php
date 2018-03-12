<?php
$conn_error = 'Could not connect';

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '1';

$mysql_db = 'coupons_app_data';

$conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
$mysql_table = 'offers_database';
if($conn === false){
  echo 'not connected';
 die($conn_error);

}else{
	echo '<p align="center">Connected</p>';
}
?>
<?php
// Create a stream
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "Fk-Affiliate-Id: komalvash\r\n" .
            "Fk-Affiliate-Token: 7c6e0e21eac043039163b4c5fb07a052\r\n"
    ]
];

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$client = file_get_contents('https://affiliate-api.flipkart.net/affiliate/offers/v1/all/json', false, $context);
$client = str_replace("'","''",$client);
?>
<?php

$store = "flipkart";
$decodedDatas = json_decode($client);
func($decodedDatas, $store,$conn);


?>
<?php
function func($decodedDatas, $store,$conn){
  foreach ($decodedDatas as $decoded) {
    foreach ($decoded as $decodedData) {
      # code...

      // foreach ($decodedData->imageUrls as $img) {
      //   foreach ($img as $image) {
      //     # code...
      //     if($image->resolutionType == "low"){
      //       $final_image = $image->url;
      //     }
      //   }
      //   # code...
      // }
      if($decodedData->availability == 'LIVE'){
        $decodedData->coupon_expiry= '2022-02-02';
      }
    // echo $decodedData->Campaign_Name."Hello</br>";
    // echo $int;
    // $returnData['Campaign_Name']=$decodedData->Campaign_Name;
    // $returnData['Title']= $decodedData->Title;
    // $returnData['Description'] = $decodedData->Description;
    // $returnData['Category'] = $decodedData ->Category;
    // $returnData['Tracking_URL'] = $decodedData ->Tracking_URL;
    foreach ($decodedData->imageUrls as $image) {
      # code...
      if($image->resolutionType =="low"){
        $imageUrl = $image->url;
      }
    }


    $query = "INSERT INTO `offers_database` (`id`, `offer_id`, `api_name`, `offer_company`,
       `offer_company_image`,`offer_title`, `offer_description`, `offer_category`, `offer_tracking_url`,
       `offer_code`,`offer_expiry_date`) VALUES (NULL, NULL, '".$store."',
       '".$decodedData->title."','".$imageUrl."' ,'".$decodedData->availability."',
        '".$decodedData->description."',
        '".$decodedData->category."', '".$decodedData->url."','NULL', '".$decodedData->coupon_expiry."');";

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
