<?php
$conn_error = 'Could not connect';

// $mysql_host = 'peak.cwtinczi5fmr.us-east-2.rds.amazonaws.com';
// $mysql_user = 'vinodsai';
// $mysql_pass = 'Sai_1234';
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "1";

$mysql_db = 'coupons_app_data';
$mysql_table = 'sign_in_table';

$conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
if($conn === false){

 die($conn_error);

}else{
	// echo '<p align="center">Connected</p>';
}

// <!-- <form action="sign_in.php" method="GET" id="hello">
//
// 	<p>Name: </p><input type="text" name="username"/></br>
// 	<p>Password: </p><input type="password" name="password"/></br>
// 	<input type="Submit" value="SignIn"/>
// </form> -->

?>
<?php
	if(isset($_GET['accName']) && isset($_GET['accIfsc']) && isset($_GET['accNo']) && $_GET['username'])
      {
		$accountName = $_GET['accName'];
		$accountIfsc = $_GET['accIfsc'];
    $accountNo = $_GET['accNo'];
    $username = $_GET['username'];

		if((!empty($accountName)) && (!empty($accountIfsc)) && (!empty($accountNo)) && (!empty($username)))
    {
			// $query = "INSERT INTO '".$mysql_table."' (id, username,password,referred_by,referral_code,wallet_balance) VALUES(NULL,'".$username."','".$password."','".$referred_by."','".$referral_code."','".$wallet_balance."')";
      $query = "UPDATE `sign_in_table` SET `account_holder` = '".$accountName."',`account_ifsc`= '".$accountIfsc."',account_number='".$accountNo."' WHERE `username` = '".$username."'";
      // $query = "SELECT * FROM sign_in_table WHERE username LIKE '".$username."' AND password LIKE '".$password."'";
      $query_run = mysqli_query($conn, $query);
      if($query_run){
        // while ($row = mysqli_fetch_assoc($query_run)) {
          # code...
          // $returnData['referral_code'] = $row['referral_code'];

        // echo "Signed In";
        // echo '
            // <script type="text/javascript">
            // document.getElementById("hello").style.display = "none";
            // </script>
        // ';
        // echo 'rows: '.mysqli_num_rows($query_run).'</br>';
        // if(mysqli_num_rows($query_run)>0){
        // while ($row = mysqli_fetch_assoc($query_run)) {
        //   // echo $row['id'].'</br>';
          $returnData['success'] = true;
          // $query = 'SELECT SUM(amount) as wallet_balance FROM `wallet_transactions` WHERE user_id = '.$row['id'];

          // if(mysqli_num_rows(mysqli_query($conn, $query))>0){
            // while($row = mysqli_fetch_assoc(mysqli_query($conn, $query))){
              // echo $row['wallet_balance'].': Wallet Balance';

              // $returnData['success'] = true;
              // $returnData['wallet_balance'] = $row['wallet_balance'];
              //
              echo json_encode($returnData);
              // return true;
              // $myObj->success = true;
              // $myObj->wallet_balance = $row['wallet_balance'];
              // $myObj->city = "New York";

              // $myJSON = json_encode($myObj);

              // return $myJSON;
            }
          }
        }
?>
