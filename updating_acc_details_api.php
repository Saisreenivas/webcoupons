
<?php
  require 'db_connect.php';
  $mysql_table = 'sign_in_table';

	if(isset($_GET['accName']) && isset($_GET['accIfsc']) && isset($_GET['accNo']) && $_GET['username'] && $_GET['redeem'] && $_GET['accBal'])
      {
		$accountName = $_GET['accName'];
		$accountIfsc = $_GET['accIfsc'];
    $accountNo = $_GET['accNo'];
    $username = $_GET['username'];
    $redeem = $_GET['redeem'];
    $accBal = $_GET['accBal'];

		if((!empty($accountName)) && (!empty($accountIfsc)) && (!empty($accountNo)) && (!empty($username)))
    {
			// $query = "INSERT INTO '".$mysql_table."' (id, username,password,referred_by,referral_code,wallet_balance) VALUES(NULL,'".$username."','".$password."','".$referred_by."','".$referral_code."','".$wallet_balance."')";
      $query = "UPDATE `sign_in_table` SET `account_holder` = '".$accountName."',`account_ifsc`= '".$accountIfsc."',account_number='".$accountNo."', redeem_balance='".$redeem."', wallet_balance='".$accBal."' WHERE `username` = '".$username."'";
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
