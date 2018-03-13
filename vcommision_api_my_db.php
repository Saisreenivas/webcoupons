<?php
$conn_error = 'Could not connect';

$mysql_host = 'peak.cwtinczi5fmr.us-east-2.rds.amazonaws.com';
$mysql_user = 'vinodsai';
$mysql_pass = 'Sai_1234';

$mysql_db = 'coupons_app_data';
$mysql_table = 'sign_in_table';

$conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
if($conn === false){

 die($conn_error);

}else{
	// echo '<p align="center">Connected</p>';
}
$presentDate = getDate()['year']."-".getDate()['mon']."-".getDate()['mday'];
?>
<?php
// <form action="icubes_api_my_db.php" method="GET" id="hello">
// <p>Name: </p><input type="text" name="username"/></br>
// <p>Password: </p><input type="password" name="password"/></br>
// <input type="Submit" value="SignIn"/>
// </form>

$record_per_page = 50;
$page = '';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}

$start_from = ($page-1)*$record_per_page;

////////////////////////////////////////////////////////////////
$page_query = "SELECT * FROM offers_database WHERE api_name LIKE 'icubeswire' AND offer_expiry_date > '".$presentDate."'";
$page_result = mysqli_query($conn, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_per_page);
$start_loop = $page;
$difference = $total_pages - $page;
if($difference <= 5)
{
 $start_loop = $total_pages - 5;
}
$end_loop = $start_loop + 4;
////////////////////////////////////////////////////////////////


$query = "SELECT * FROM `offers_database` WHERE `api_name` LIKE 'vcommission' AND `offer_expiry_date` > '".$presentDate."' LIMIT $start_from, $record_per_page ";

$query_run = mysqli_query($conn, $query);
$my_array = array();
if(mysqli_num_rows($query_run)>0){
  while($row = mysqli_fetch_assoc($query_run)){
    $returnData['ID'] = $row['offer_id'];
    $returnData['store_name']=$row['offer_company'];
    $returnData['offer_name']= $row['offer_title'];
    $returnData['category'] =$row['offer_description'];
    $returnData['coupon_title'] = $row['offer_category'];
    $returnData['store_link'] =$row['offer_tracking_url'];
    $returnData['store_image']=$row['offer_company_image'];

    array_push($my_array, $returnData);
  }

  echo json_encode($my_array);
}

?>
