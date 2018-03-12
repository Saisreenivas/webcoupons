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
$client = file_get_contents('https://tools.vcommission.com/api/coupons.php?apikey=17c554a945c8fe66424fabc11c81b81aea0d635866fa279a26eb21c37b0e8e70');
$store = "vcommission";
$decodedData = json_decode($client);
func($decodedData, $store,$conn);


?>
<?php
function func($decodedData, $store,$conn){
  foreach ($decodedData as $decodedData) {
    // echo $decodedData->Campaign_Name."Hello</br>";
    // echo $int;
    // $returnData['Campaign_Name']=$decodedData->Campaign_Name;
    // $returnData['Title']= $decodedData->Title;
    // $returnData['Description'] = $decodedData->Description;
    // $returnData['Category'] = $decodedData ->Category;
    // $returnData['Tracking_URL'] = $decodedData ->Tracking_URL;

    $query = "INSERT INTO `offers_database` (`id`, `offer_id`, `api_name`, `offer_company`,
       `offer_company_image`,`offer_title`, `offer_description`, `offer_category`, `offer_tracking_url`,
       `offer_code`,`offer_expiry_date`) VALUES (NULL, '".$decodedData->offer_id."', '".$store."',
       '".$decodedData->offer_name."','".$decodedData->store_image."', '".$decodedData->coupon_title."', '".$decodedData->coupon_description."',
        '".$decodedData->category."', '".$decodedData->store_link."','".$decodedData->coupon_code."', '".$decodedData->coupon_expiry."');";

        if($data = mysqli_query($conn, $query)){
           echo 'success';
        }else{
          echo "</br>".mysqli_error($conn);
          continue;
          // echo "</br> Result error".mysqli_error($conn);
        }
  }
}
    # code...
    // echo json_encode(returnData);
    // if($int ==1){
    // echo "[";
    // }
    // echo json_encode($returnData);
    // if($int==100){
    //   // echo "]";
    //   echo json_encode($result);
    //   return true;
    // }
    // else{
    //   // echo ",";
    //   array_push($result,$returnData);
    //   $int++;
    // }

 ?>
