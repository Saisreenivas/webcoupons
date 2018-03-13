<?php
$conn_error = 'Could not connect';

$mysql_host = 'peak.cwtinczi5fmr.us-east-2.rds.amazonaws.com';
$mysql_user = 'vinodsai';
$mysql_pass = 'Sai_1234';

$mysql_db = 'coupons_app_data';
$mysql_table = 'offers_database';

$conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
if($conn === false){

 die($conn_error);

}else{
	// echo '<p align="center">Connected</p>';
}
$presentDate = getDate()['year']."-".getDate()['mon']."-".getDate()['mday'];
?>
<?php

$categories = ['Fashion', 'Food & Dining', 'Travel', 'Mobiles & Tablets',
'Beauty & Health', 'Recharge', 'Computers, Laptops & Gaming', 'Appliances',
'Home Furnishing & Decor', 'Computers & Accessories', 'Flowers,Gifts & Jewellery',
'Miscellaneous'];
// 'Kids,Babies & Toys', 'Web Hosting & Domains', 'Books & Stationary',
// 'Automotive', 'Adult','Education & Learning', 'Local Services'];



if(isset($_GET["para1"]) && isset($_GET["para2"]) && isset($_GET["para3"])
                            && isset($_GET["para4"]) && isset($_GET["present"])){

                              // $present =
        $categ_array = array();

        // $j=4;
        $cont =0;

          $k=1;
          $my_array = array();
          $sub_cat['name'] = 'All';

          if($_GET["present"] == "All" || $_GET["present"] == "all"){
            $j=4;
            $sub_categories = [$_GET["para1"], $_GET["para2"], $_GET["para3"], $_GET["para4"]];
            // echo $sub_categories[0].'</br>';
          }
          else{
            $j=1;
            $sub_categories = [$_GET["present"]];
            // echo $sub_categories[0].'</br>';
          }

          for ($i=0;$i<$j;$i++) {

            if(strpos($sub_categories[$i], ' ') !== false || strpos($sub_categories[$i], '&') !==  false)   {

              if(strpos($sub_categories[$i], '&') !== false){
                $cont =1;
                $word = explode(' & ', $sub_categories[$i]);
                // echo $sub_category;
              }

              $sub_category = str_replace(" ", "%",$sub_categories[$i] );
              $sub_category = str_replace("&%", "",$sub_category );
              // echo $sub_category;
            }else{
              $sub_category = $sub_categories[$i];
              // echo $sub_category;
            }

            if($cont == 0){
              // echo $presentDate;
              // echo $sub_category;

                $query = "SELECT * FROM `offers_database`  where `offer_expiry_date` > '".$presentDate."'
                and offer_description LIKE '%".$sub_category."%' OR  offer_company LIKE '%".$sub_category
                ."%' OR offer_title LIKE '%".$sub_category."%';";

                $myquery = mysqli_query($conn, $query);
                if(mysqli_num_rows($myquery)>0){
                  // $oops = mysqli_num_rows($myquery);
                  // echo $oops."</br></br></br></br></br>";
                  while($row = mysqli_fetch_assoc($myquery)){
                    $returnData['ID'] = $row['offer_id'];
                    $returnData['title']=$row['offer_company'];
                    $returnData['availability']= $row['offer_title'];
                    $returnData['description'] =$row['offer_description'];
                    $returnData['category'] = $row['offer_category'];
                    $returnData['url'] =$row['offer_tracking_url'];
                    $returnData['image_url']= $row['offer_company_image'];

                    array_push($my_array, $returnData);
                  }

                  // echo json_encode($my_array);
                  // echo '</br>'.mysqli_num_rows($myquery).'</br>';
                }
              }else if(cont ==1 ){
                $query = "SELECT * FROM `offers_database`  where `offer_expiry_date` > '"
                  .$presentDate."' and offer_description LIKE '%".$word[0]."%' OR
                  offer_description LIKE '%".$word[1]."%' OR  offer_company LIKE '%".$word[0]
                  ."%' OR  offer_company LIKE '%".$word[1]."%'  OR offer_title
                  like '%".$word[0]."%' or offer_title like '%".$word[1]."%'";

                $myquery = mysqli_query($conn, $query);
                  if(mysqli_num_rows($myquery)>0){
                    // $oops = mysqli_num_rows($myquery);
                    // echo $oops."</br></br></br></br></br>";
                    while($row = mysqli_fetch_assoc($myquery)){
                      $returnData['ID'] = $row['offer_id'];
                      $returnData['title']=$row['offer_company'];
                      $returnData['availability']= $row['offer_title'];
                      $returnData['description'] =$row['offer_description'];
                      $returnData['category'] = $row['offer_category'];
                      $returnData['url'] =$row['offer_tracking_url'];
                      $returnData['image_url']= $row['offer_company_image'];

                      array_push($my_array, $returnData);
                    }

                    // echo json_encode($my_array);
                  }
                    $cont =0;
                    // echo mysqli_num_rows($myquery).'</br>';
              }

              // echo "loop".$i."</br></br></br></br></br></br>";
          }

          echo json_encode($my_array);
          // $hey['offer_category'] = $category;
          // $hey['data'] =  $sub_cat;
          // array_push($categ_array,$hey);
        // echo json_encode($categ_array);
}
?>
