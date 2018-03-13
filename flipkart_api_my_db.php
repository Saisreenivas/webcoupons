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


$store="flipkart";


$query = "SELECT * FROM offers_database WHERE api_name LIKE 'flipkart' AND 'offer_expiry_date' > '".$presentDate."' LIMIT $start_from, $record_per_page";

$query_run = mysqli_query($conn, $query);
$my_array = array();
if(mysqli_num_rows($query_run)>0){
  while($row = mysqli_fetch_assoc($query_run)){
    $returnData['ID'] = $row['offer_id'];
    $returnData['title']=$row['offer_company'];
    $returnData['availability']= $row['offer_title'];
    $returnData['description'] =$row['offer_description'];
    $returnData['category'] = $row['offer_category'];
    $returnData['url'] =$row['offer_tracking_url'];
    $returnData['image_url']= $row['offer_company_image'];

    array_push($my_array, $returnData);
  }

  echo json_encode($my_array);
}

?>
